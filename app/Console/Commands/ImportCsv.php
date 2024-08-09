<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Record;
use App\Models\Instance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import'; //php artisan import-csv no terminal para realizar a importação

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $file = storage_path('../teses_e_dissertacoes_tombo.csv'); //encontrando o diretório do arquivo CSV
        
        if(file_exists($file)) {
            $this->info('Processando CSV...');

            $fileHash = md5_file($file);
            $logFile = storage_path('app/imported_files.log');

            // Verificar se o hash já está no arquivo de log
            if (File::exists($logFile)) {
                $importedFiles = File::get($logFile);
                $importedFilesArray = explode(PHP_EOL, trim($importedFiles));

                // if (in_array($fileHash, $importedFilesArray)) {
                //     $this->error('Este arquivo CSV já foi importado.');
                //     return 0;
                // } ativar somente depois que executou o comando
            }

            $csvData = array_map('str_getcsv', file($file)); //Lê o arquivo e converte cada linha em um array
            $cabecalho = array_shift($csvData); // Remove e retorna a primeira linha (cabeçalho)

            $autores = array_search('autores', $cabecalho);
            $titulo = array_search('titulo', $cabecalho);
            $localPub = array_search('local', $cabecalho);
            // $desc_fisica = array_search('desc_fisica', $cabecalho);
            $editora = array_search('editora', $cabecalho);
            $edicao = array_search('edicao', $cabecalho);
            $assunto = array_search('assunto', $cabecalho);
            $local_publicacao = array_search('local', $cabecalho);
            $idioma = array_search('idioma', $cabecalho);
            $isbn = array_search('isbn', $cabecalho);
            $issn = array_search('issn', $cabecalho);
            $ano = array_search('ano', $cabecalho);
            $tipo = array_search('tipo', $cabecalho);
            $orientador = array_search('orientador', $cabecalho);
            $quantidade = array_search('quantidade', $cabecalho);
            $numero = array_search('numero', $cabecalho);
            $localizacao = array_search('localizacao', $cabecalho);

            foreach ($csvData as $row) {

                $Newtipo = null;
                if ($tipo !== false) {
                    if ($row[$tipo] === 'M') {
                        $Newtipo = 'Dissertação';
                    } elseif ($row[$tipo] === 'D' || $row[$tipo] === 'LD') {
                        $Newtipo = 'Tese';
                    } else {
                        $Newtipo = $row[$tipo];
                    }
                }

                $Newidioma = null;
                if($idioma !== false){
                    if($row[$idioma] === 'PT-BR'){
                        $Newidioma = 'pt_BR'; //Utils idioma == Português do Brasil. Isso serve para poder ser editado
                    }else{
                        $Newidioma = $row[$idioma];
                    }
                }

                $Newautores = $autores !== false ? $row[$autores] : null;
                $Newtitulo = $titulo !== false ? $row[$titulo] : null;
                $NewlocalPub = $localPub !== false ? $row[$localPub] : null;
                // $Newdesc_fisica = $desc_fisica !== false ? $row[$desc_fisica] : null;
                $Neweditora = $editora !== false ? $row[$editora] : null;
                $Newedicao = $edicao !== false ? $row[$edicao] : null;
                $Newassunto = $assunto !== false ? $row[$assunto] : null;
                // $Newidioma = $idioma !== false ? $row[$idioma] : null;
                $Newisbn = $isbn !== false ? $row[$isbn] : null;
                $Newissn = $issn !== false ? $row[$issn] : null;
                $Newano = $ano !== false ? $row[$ano] : null;
                // $Newtipo = $tipo !== false ? $row[$tipo] : null;
                // $Newtipo = $tipo !== false ? ($row[$tipo] === 'M' ? 'Mestrado' : $row[$tipo]) : null;
                $Neworientador = $orientador !== false ? $row[$orientador] : null;
                $Newquantidade = $quantidade !== false ? $row[$quantidade] : null;
                $Newnumero = $numero !== false ? $row[$numero] : null;
                $Newlocalizacao = $localizacao !== false ? $row[$localizacao] : null;

                $record = new Record;
                $record->autores = $Newautores;
                $record->titulo = $Newtitulo;
                // $record->desc_fisica = $Newdesc_fisica;
                $record->editora = $Neweditora;
                $record->assunto = $Newassunto;
                $record->local_publicacao = $NewlocalPub;
                $record->edicao = $Newedicao;
                $record->ano = $Newano;
                $record->idioma = $Newidioma;
                $record->isbn = $Newisbn;
                $record->issn = $Newissn;
                $record->tipo = $Newtipo;
                $record->orientador = $Neworientador;
                $record->save();

                $instance = new Instance;
                $instance->record_id = $record->id;
                $instance->tombo = rand(1, 10000000);
                $instance->localizacao = $Newlocalizacao;
                $instance->save();
            }

            // Append the file hash to the log
            File::append($logFile, $fileHash . PHP_EOL);

            $this->info('Import completo');
            return 0;
        } else {
            $this->error('Arquivo CSV não encontrado');
            return 1;
        }
    }
}
