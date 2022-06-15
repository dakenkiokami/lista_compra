<?php

require_once('Controller.php');
require_once(__DIR__ . '/../Model/Product.php');

class ProductController extends Controller
{

    public function list()
    {
        $products = Product::selectAll();
        return $this->view(__DIR__ . '/../View/Product/ProductList', ['products' => $products]);
    }

    public function create()
    {
        return $this->view(__DIR__ . '/../View/Product/ProductCreate');
    }

    public function edit($data)
    {
        $product_id = (int) $data['product_id'];
        $product = Product::selectById($product_id);

        return $this->view(__DIR__ . '/../View/Product/ProductUpdate', ['product' => $product]);
    }

    public function save()
    {
        $product = new Product;
        $product->setProductName($this->request->product_name);
        if ($product->saveProduct()) {
            return $this->list();
        }
    }

    public function update($data)
    {
        $product_id = (int) $data['product_id'];
        $product = Product::selectById($product_id);
        $product->setProductName($this->request->product_name);
        $product->saveProduct();

        return $this->list();
    }

    public function delete($data)
    {
        $product_id = (int) $data['product_id'];
        $product = Product::deleteProduct($product_id);

        return $this->list();
    }
}
