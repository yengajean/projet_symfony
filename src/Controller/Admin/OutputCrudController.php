<?php

namespace App\Controller\Admin;

use App\Entity\Output;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OutputCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Output::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
