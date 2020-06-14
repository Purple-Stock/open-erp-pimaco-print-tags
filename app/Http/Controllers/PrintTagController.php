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

    public function generatePrintTags(Request $request)
    {
    	$pimaco = new Pimaco($request["pimaco"]);
    	for ($i = 0; $i <= count($request["product_name"]) - 1; $i++) {
    		for ($j = 0; $j <= $request["quantity"][$i] - 1; $j++) {
				$tag = new Tag();
				$tag->setPadding(3);
				$tag->img("https://17741.static.simplo7.net/static/17741/configuracao/logo_151893456531094.png")->setHeight(20)->setAlign('right');
                $tag->qrcode('{"id":'.$request["product_id"][$i].',"custom_id":"'.$request["custom_id"][$i].'","name":"'.$request["product_name"][$i].'"}')->setSize(80)->br();
                $tag->p($request["product_name"][$i])->setSize(2);
				$tag->p(' R$:'.$request["price"][$i])->b()->setSize(2);
				$pimaco->addTag($tag);
			}
    	}

		$pimaco->output();
    }
}
