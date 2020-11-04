<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Scriptotek\Marc\Record as Marc;
use App\Models\Record;
use App\Models\Instance;
use Illuminate\Support\Facades\DB;
use PDO;
use Storage;

class migra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migra';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migração Biblivre';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        #
        # Neste exemplo vou fazer para um registro, que será 10492
        # 1. Fazer um loop para aplicar em todos

        # 2. Vou ler um string, mas esse campo deve vir do banco postgres da tabela
        # select record from cataloging_biblio where record_serial=10492;

        #### Instruções ####
        /* No arquivo abaixo
         * vendor/scriptotek/marc/src/Fields/SerializableField.php
         * Deixar a linha:
         *    <-- return (string) $this; -->
         * Assim:
         *    <-- return $this; -->
         */

        /* criar as seguintes variáveis no .env */
        $host = env('POSTGRES_HOST');
        $db = env('POSTGRES_DATABASE');
        $username = env('POSTGRES_USERNAME');
        $password = env('POSTGRES_PASSWORD');

        try {
            $myPdo = new PDO("pgsql:host=$host, dbname=$db", $username, $password);
        }
        catch(Exception $e) {
            echo "error $e->getMessage() \n";
        }
        $instance_orfao = $myPdo->query('select count(ch.holding_serial)
                       from cataloging_holdings ch where ch.record_serial not in
                       (select cb.record_serial from cataloging_biblio cb)');
        foreach($instance_orfao as $total){
            $total_instance_orfao = $total['count'];
        }
        $result = $myPdo->query('select record_serial, record
                                 from cataloging_biblio order by record_serial');
        $total_registro = 0;
        $total_registro_inserido = 0;
        $total_instance = 0;
        $total_record_sem_titulo = 0;
        foreach($result as $value) {
            $biblio_records = Marc::fromString($value['record']);

            $total_registro += 1;
            $biblio_id = $this->getId($biblio_records) ?: $value['record_serial'];

            $cataloging_holdings = $myPdo->query("select holding_serial, record
                    from cataloging_holdings where record_serial = $biblio_id");

            # 4. Gravando dados no model desse sistema
                echo $biblio_id . "\n";
                DB::transaction(function ()
                    use($biblio_id, $biblio_records, $cataloging_holdings,
                        &$total_instance, &$total_registro_inserido,
                        &$total_record_sem_titulo) {
                    $record = new Record;
                    $record->id = $biblio_id;
                    $record->autores = $this->getAutor($biblio_records);
                    $record->titulo = $this->getTitulo($biblio_records);
                    $record->desc_fisica = $this->getDescFisica($biblio_records);
                    $record->editora = $this->getEditora($biblio_records);
                    $record->assunto = $this->getAssunto($biblio_records);
                    $record->local_publicacao = $this->getLocalPublicacao($biblio_records);
                    $record->edicao = $this->getEdicao($biblio_records);
                    $record->ano = $this->getAnoPublicacao($biblio_records);
                    $record->idioma = $this->getIdioma($biblio_records);
                    $record->isbn = $this->getIsbn($biblio_records);
                    $record->issn = $this->getIssn($biblio_records);
                    $record->tipo = 'Livro';

                    if($record->titulo) {
                        $record->save();
                        $total_registro_inserido += 1;

                        if($cataloging_holdings->rowCount() > 0) {
                            foreach($cataloging_holdings as $value) {
                                $holdings_records = Marc::fromString($value['record']);
                                $instance = new Instance;
                                $instance->id = $value['holding_serial'];
                                $instance->tombo = $this->getTombo($holdings_records);
                                $instance->localizacao = $this->getLocalizacao($holdings_records);
                                $instance->record_id = $biblio_id;
                                $instance->save();
                                $total_instance += 1;
                            }
                        }
                    }
                    else {
                        $total_record_sem_titulo += 1;
                        $this->makeFileOffTitle($record);
                    }
                });

        }

        $instance_record_off = $myPdo->query('select ch.record from cataloging_holdings ch
        where ch.record_serial not in (select cb.record_serial from cataloging_biblio cb)');

        if($instance_record_off->rowCount() > 0) {
            foreach($instance_record_off as $value) {
                $marc_records = Marc::fromString($value['record']);
                $this->makeFileOffRecord($marc_records);
            }
        }

        echo "\nTotal de records = $total_registro\n";
        echo "Total de records inserido = $total_registro_inserido\n";
        echo "Records não inseridos porque não possui título = $total_record_sem_titulo\n";
        echo "Total de instances inserido = $total_instance\n";
        echo "Total de instance orfão = $total_instance_orfao\n";
        echo "Arquivos gerados estão em storage/app/, são eles:
                 offrecords.txt e offtitle.txt\n";

    }

    private function getData($marc, $field, $code_subfield) {
        if($marc->getField($field)) {
            foreach($marc->getField($field)->getSubfields() as $subfield) {
                if($subfield->getCode() == $code_subfield) {
                    return trim($subfield->getData());
                }
            }
        }
        return null;
    }
    private function getLocalizacao($marc) {
        $localizacao = [];
        if($marc->getField('90')) {
            foreach($marc->getField('90')->getSubfields() as $subfields) {
                    $localizacao[] = trim($subfields->getData());
            }
            return implode(' ', $localizacao);
        }
        return null;
    }

    private function getTitulo($marc) {
        $field = '245';
        $code_subfield = 'a';
        if($this->getData($marc, $field, $code_subfield))
            return $this->getData($marc, $field, $code_subfield);
        else {
            $field = '240';
            return $this->getData($marc, $field, $code_subfield);
        }

        return null;
    }

    private function getIsbn($marc) {
        $field = '020';
        $code_subfield = 'a';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getIssn($marc) {
        $field = '022';
        $code_subfield = 'a';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getLocalPublicacao($marc) {
        $field = '260';
        $code_subfield = 'a';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getEdicao($marc) {
        $field = '250';
        $code_subfield = 'a';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getAnoPublicacao($marc) {
        $field = '260';
        $code_subfield = 'c';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getEditora($marc) {
        $field = '260';
        $code_subfield = 'b';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function getIdioma($marc) {
        $field = '041';
        $code_subfield = 'a';
        $idioma = $this->getData($marc, $field, $code_subfield);
        $japones = ['jap', 'jpn', 'ja', 'jp'];
        $ingles =  ['en', 'ing', 'eng'];
        $portugues = ['por', 'prt'];
        if($idioma) {
            if(in_array(strtolower(substr($idioma, 0, 3)), $japones)){
                return 'ja';
            }
            elseif(in_array(strtolower(substr($idioma, 0, 3)), $ingles)){
                return 'en';
            }
            elseif(in_array(strtolower(substr($idioma, 0, 3)), $portugues)){
                return 'pt_BR';
            }
            else {
                return null;
            }
        }
        return $idioma;
    }

    private function getDescFisica($marc) {
        $descricao_fisica = [];
        if($marc->getField('300')) {
            foreach($marc->getField('300')->getSubfields() as $subfield){
                $descricao_fisica[] = trim($subfield->getData());
            }
            return implode(' ', $descricao_fisica);
        }
        return null;
    }

    private function getAssunto($marc) {
        $assunto = [];
        if($marc->getField('650')) {
            foreach($marc->getField('650')->getSubfields() as $subfield){
                $assunto[] = trim($subfield->getData());
            }
            return implode(' - ', $assunto);
        }
        return null;
    }

    private function getAutor($marc) {
        $fields = $marc->jsonSerialize();
        $autores = [];
        foreach($fields['creators'] as $autor) {
            $autores[] = $autor['name'];
        }
        return implode(' - ', $autores);
    }

    private function getId($marc) {
        if($marc->getField('001')) {
            return $marc->getField('001')->getData();
        }
        return null;
    }

    private function getTombo($marc) {
        $field = '949';
        $code_subfield = 'a';
        return $this->getData($marc, $field, $code_subfield);
    }

    private function makeFileOffTitle($record) {
        try {
            $txt = "record_serial = $record->id\n";
            $txt .= "autor(es) = $record->autores\n";
            $txt .= "título = $record->titulo\n";
            $txt .= "descrição física = $record->desc_fisica\n";
            $txt .= "editora = $record->editora\n";
            $txt .= "assunto = $record->assunto\n";
            $txt .= "local publicação = $record->local_publicacao\n";
            $txt .= "localização = $record->localizacao\n";
            $txt .= "edição = $record->edicao\n";
            $txt .= "ano = $record->ano\n";
            $txt .= "idioma = $record->idioma\n";
            $txt .= "isbn = $record->isbn\n";
            $txt .= "issn = $record->issn\n";
            $txt .= "\n=====================================================\n";
            Storage::disk('local')->append("offtitle.txt", $txt);
        }
        catch(Exception $e) {
            echo "Erro ao gravar no arquivo $e";
        }
    }

    private function makeFileOffRecord($marc_records) {
        try {
            $txt = "Tombo = " . $this->getTombo($marc_records) . "\n";
            $txt .= "Localização = " . $this->getLocalizacao($marc_records) . "\n";
            $txt .= "\n=====================================================\n";
            Storage::disk('local')->append("offrecord.txt", $txt);
        }
        catch(Exception $e) {
            echo "Erro ao gravar no arquivo $e";
        }
    }

}

