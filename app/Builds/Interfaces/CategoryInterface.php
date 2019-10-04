<?php


namespace App\Builds\Interfaces;


interface CategoryInterface
{

    public function index();

    public function show($id, $request);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($id, $request);

    public function destroy($id);

    public function inactive($id);

}