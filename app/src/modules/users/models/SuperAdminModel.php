<?php

namespace users\models;

interface SuperAdminModel
{
    public function approve();
    public function ban();
    public function deleteItem();
    public function messages();
}