<?php 

namespace App\Services;
use Request;

interface CarServiceInterface
{
    public function index();
    public function show($id);
    public function store(Request $request);
    public function update($id, Request $request);
    public function destroy($id);
}