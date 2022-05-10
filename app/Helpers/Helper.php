<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class Helper
{
    public static function category($categorys, $parent_id = 0, $char = '') {
        $html = '';

        foreach ($categorys as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $category->id . '</td>
                        <td>' . $char . $category->name . '</td>
                        <td>' . $category->description . '</td>
                        <td>' . self::active($category->active) . '</td>
                        <td>' . $category->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/categorys/edit/' . $category->id .'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="removeRow(' . $category->id .', \'/admin/categorys/destroy\')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($categorys[$key]);

                $html .= self::category($categorys, $category->id, $char . '--');
            }
        }

        return $html;
    }

    public static function active($active = 0) : string {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function categorys($categorys, $parent_id = 0) {
        $html = '';
        foreach ($categorys as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $category->id . '-'. Str::slug($category->name, '-') .'.html">
                            ' . $category->name . '
                        </a>';
                if (self::isChild($categorys, $category->id)) {
                    $html .= '<ul class="header__menu__dropdown">';
                    $html .= self::categorys($categorys, $category->id);
                    $html.= '</ul>';
                }

                $html  .= '</li>
                ';
            }
        }

        return $html;
    }

    public static function isChild($categorys, $id) {
        foreach ($categorys as $key => $category) {
            if($category->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

    public static function price($price = 0, $price_sale = 0) {
        if ($price_sale != 0)
            return
                '<div class="product-price ">' . number_format($price_sale, 0, '', '.') . 'đ' .
                    '<del class="product-del pl-3">' . number_format($price, 0, '', '.') . 'đ' .'</del>
                </div>';
        if ($price != 0)
            return '<div class="product-price">' . number_format($price, 0, '', '.') . 'đ' .'</div>';
    }

    public static function accountIsAdmin() {
        if(Gate::allows('admin')) {
            return false;
        } else if (Gate::allows('user')){
            return redirect('/');
        } else if (Gate::allows('sale')) {
            return redirect('/sale');
        }
    }

    public static function accountIsUser() {
        if(Gate::allows('admin')) {
            return redirect('/admin');
        } else if (Gate::allows('user')){
            return false;
        } else if (Gate::allows('sale')) {
            return redirect('/sale');
        }
    }

    public static function accountIsSale() {
        if(Gate::allows('admin')) {
            return redirect('/admin');
        } else if (Gate::allows('user')){
            return redirect('/');
        } else if (Gate::allows('sale')) {
            return false;
        }
    }

    public static function account() {
        if(Gate::allows('admin')) {
            return redirect('/admin');
        } else if (Gate::allows('user')){
            return redirect('/');
        } else if (Gate::allows('sale')) {
            return redirect('/sale');
        }
    }
}
