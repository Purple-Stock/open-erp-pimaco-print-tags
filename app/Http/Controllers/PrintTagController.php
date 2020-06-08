<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;

class PrintTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {	
    	return view('print_tags.index');
    }

    public function generatePrintTags()
    {
    	$pimaco = new Pimaco('A4360');

		$tag = new Tag();
		$tag->setPadding(3);
		$tag->img("https://17741.static.simplo7.net/static/17741/configuracao/logo_151893456531094.png")->setHeight(20)->setAlign('right');
		$tag->setBorder(0.1);
		$tag->qrcode('tetas')->setMargin(array(0,2,1,0))->br();
		$tag->p('0001 - Produto de Teste 1')->setSize(3)->br();
		$tag->p('R$: 9,90')->b()->setSize(5);
		$pimaco->addTag($tag);

		$tag = new Tag();
		$tag->setPadding(3);
		$tag->img("https://17741.static.simplo7.net/static/17741/configuracao/logo_151893456531094.png")->setHeight(20)->setAlign('right');
		$tag->setBorder(0.1);
		$tag->qrcode('tetas')->setMargin(array(0,2,1,0))->br();
		$tag->p('0002 - Produto de Teste 2')->setSize(3)->br();
		$tag->p('R$: 29,90')->b()->setSize(5);
		$pimaco->addTag($tag);

		$pimaco->output();
    }
}
