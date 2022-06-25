<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    #[Route('/product', name: 'Product')]

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IdField::new('category_id'),
            TextField::new('name'),
            TextEditorField::new('description'),
            TextEditorField::new('image'),
            MoneyField::new('price')->setCurrency('UAH'),
        ];
    }
    
}
