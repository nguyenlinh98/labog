<?php


namespace App\Builds\Interfaces;


interface UserInterface
{
    public function index();

    public function inactive($id);

    public function show($id, $request);

    public function create($request);

    public function store();

    public function edit($id);

    public function update($request, $id);

    public function  destroy($id);

    public function profile();

    public function updateProfile($request);

    public function password(array $request, $id);

}