    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RibController extends Controller
{
    public function rib(){
        return new Response("ribcontroller", Response::HTTP_OK);
    }

}
