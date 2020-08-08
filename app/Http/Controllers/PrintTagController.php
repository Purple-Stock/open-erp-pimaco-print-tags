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
    	for ($i = 0; $i <= count($request["product"]) - 1; $i++) {
    		for ($j = 0; $j <= $request["quantity"][$i] - 1; $j++) {
                $product_data = explode('-', $request["product"][$i]); 
				$tag = new Tag();
				$tag->setPadding(3);
				$tag->img("https://17741.static.simplo7.net/static/17741/configuracao/logo_151893456531094.png")->setHeight(20)->setAlign('right');
                $tag->qrcode('{"id":'.$product_data[0].',"custom_id":"'.$product_data[1].'","name":"'.$product_data[2].'","price":"'.$product_data[3].'"}')->setSize(80)->br();
                $tag->p($product_data[1].'-'.$product_data[2])->setSize(2);
				$tag->p('-'.$product_data[3])->b()->setSize(2);
				$pimaco->addTag($tag);
			}
    	}

		return response()->download($pimaco->output());
    }


    public function generateExternalPrintTags(Request $request)
    {
        $pimaco = new Pimaco($request["pimaco"]);
        for ($i = 0; $i <= count($request["products"]) - 1; $i++) {
            for ($j = 0; $j <= $request["products"][$i]["quantity"] - 1; $j++) {
                $product_data = explode('-', $request["products"][$i]['name_product']);
                $tag = new Tag();
                $tag->setPadding(3);
                $tag->img("https://17741.static.simplo7.net/static/17741/configuracao/logo_151893456531094.png")->setHeight(20)->setAlign('right');
                $tag->qrcode('{"id":'.$product_data[0].',"custom_id":"'.$product_data[1].'","name":"'.$product_data[2].'","price":"'.$product_data[3].'"}')->setSize(80)->br();
                $tag->p($product_data[1].'-'.$product_data[2])->setSize(2);
                $tag->p('-'.$product_data[3])->b()->setSize(2);
                $pimaco->addTag($tag);
            }
        }

        return response()->download($pimaco->output());
    }
}
