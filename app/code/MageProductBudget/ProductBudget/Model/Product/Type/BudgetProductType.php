<?php
 
// app/code/[VendorName]/[ModuleName]/Model/Product/Type/MdProductType.php
 
namespace MageProductBudget\ProductBudget\Model\Product\Type;
 
use Magento\Catalog\Model\Product\Type\AbstractType;
 
class BudgetProductType extends AbstractType
{
   
   const TYPE_CODE = 'budget_product_type';
 
   /**
    * {@inheritdoc}
    */
   public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
   {
       
   }
}