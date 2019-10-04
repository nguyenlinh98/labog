<?php


namespace App\Builds\Interfaces;


interface PostInterface
{
 public function index();

 public function create();

 public function store($request);

 public function edit ($id);

 public function update($request ,$id);

 public function inactive($id);

 public function destroy($id);
}