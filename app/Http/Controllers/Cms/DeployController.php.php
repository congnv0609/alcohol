<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class DeployController extends Controller
{
    //
    public function index(){
        $process = new Process(['/deploy.sh']);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
        // return response()->json(['msg'=>'deployed'], 200);
    }
}
