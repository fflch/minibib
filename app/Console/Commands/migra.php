<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Scriptotek\Marc\Record as Marc;
use App\Models\Record;

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
        # Neste exemplo vou fazer para um registro, que será 10492
        # 1. Fazer um loop para aplicar em todos

        # 2. Vou ler um string, mas esse campo deve vir do banco postgres da tabela
        # select record from cataloging_biblio where record_serial=10492;
        $marc = "00661cam a2200193 a 4500001000800000005001900008008004100027020007900068040000800147041000800155090002400163100002200187245006600209260004000275500005600315650002800371700002000399710004800419\x1E0039476\x1E20150514144821.952\x1E130227s||||     bl|||||||||||||||||por|u\x1E  \x1Fa4789004732 9784789004732 4789004996 9784789004992 4789004724 9784789004725\x1E  \x1Fbpor\x1E0 \x1Fajap\x1E  \x1FaA 811.1\x1FbMo83t\x1Fcv.1\x1E1 \x1FaMotohashi, Fujiko\x1E10\x1Fa24 Tasks for basic modern Japanese = \x1FbNihongo kite hanashite\x1E  \x1FaTokyo : \x1FbJapan Times, Ltd., \x1Fc1989\x1E  \x1FaTo be used with An Introduction to Modern Japanese.\x1E 4\x1FaLÍNGUA JAPONESA\x1FxAUDIO\x1E1_\x1FaHayashi, Satoko\x1E0_\x1FaTsuda Center for Japanese Language Teaching\x1E\x1D";
        #$marc = "00702nas a2200181 a 4500001000800000005001900008008004100027041000800068090001600076245017500092260004700267300001100314500003000325650003600355650003300391650003300424711006300457\x1E0039089\x1E20150317140542.822\x1E120912s||||     bl|||||||||||||||||por|u\x1E0 \x1Fapor\x1E  \x1FaP\x1FbEn58\x1Fc11\x1E10\x1Fa Anais [do] XI Encontro nacional de professores universitários de língua, literatura e cultura japonesa [e] I Encontro de estudos japoneses :\x1Fb1 e 2 de setembro de 2000\x1E  \x1FaBrasília\x1FbUniversidade de Brasília\x1Fc2000\x1E  \x1Fa485 p.\x1E  \x1Fa1 e 2 de setembro de 2000\x1E 4\x1FaLITERATURA JAPONESA\x1FxCONGRESSOS\x1E  \x1FaCULTURA JAPONESA\x1FxCONGRESSOS\x1E  \x1FaLÍNGUA JAPONESA\x1FxCONGRESSOS\x1E0 \x1FaEncontro de estudos japoneses (1. : 2000 : Brasília, DF).\x1E\x1D";

        # 3. parser
        $fields = Marc::fromString($marc)->jsonSerialize();
        #dd($fields);

        # 4. Gravando dados no model desse sistema
        $record = new Record;
        #$record->id = # record_serial;

        $autores = ''; 
        foreach($fields['creators'] as $autor){
            $autores = $autores . ', ' . $autor['name'];
        }
        $record->autores = $autores;

        $record->titulo = $fields['title'];
        $record->editora = $fields['publisher'];
        $record->ano = $fields['pub_year'];
        $record->tipo = 'Livro';
        $record->save();

        # pegar as instâncias
        # tombo: asset_holding
        # localização: está em marc e com problema...
        # select record  from cataloging_holdings where record_serial=678;
        $loc = "00215nu  a2200097un 4500001000800000004000400008005001900012090001900031541005700050949001000107\x1E0000636\x1E678\x1E20120911145122.156\x1E  \x1Fa334.462\x1FbMe38a\x1E 4\x1FaProfa. Dra. Luiza Nana Yoshida\x1Fcdoação\x1Fd11/09/2012\x1E  \x1Fa31926\x1E\x1D";
        dd(preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', explode(' ',$loc)[5]));
        $fields = Marc::fromString($loc)->jsonSerialize();
        dd($fields);

        return 0;
    }
}
