<?php

use App\Http\Traits\HelperTrait;

function generate_tree($categories)
{
    foreach ($categories as $category) {
        $string = "";
        if (!$category->children->isEmpty()) {
            $string .= 'data-toggle="dropdown"
            class="dropdown-toggle"';
        }

        echo '<li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-259' . $category->id . ' dropdown" id="' . $category->id . '">


        <a title="' . $category->name . '" href="' . route('categoryDetail', ['id' => $category->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $category->product_title)))]) . '"' . $string . ' aria-haspopup="true">' . $category->name . '</a>';
        if ($category->children) {
            if (!$category->children->isEmpty()) {
                echo '
            <ul role="menu" class=" dropdown-menu">
                <li class="menu-item animate-dropdown menu-item-object-static_block">
                    <div class="yamm-content">

                        <div class="vc_row row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <ul>
                                                  ';
                generate_tree($category->children);
                echo ' </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
     </ul>
</li>';
                ;

            }


        }

    }
}

function affiliateprice($basePrice)
{
    $profitMargin = 1;
    $shipping = 0.25;
    $stripeFee = 0.03;

    $finalPrice = (0.40 * $profitMargin) - (0.25 * $shipping) - (0.30 * $stripeFee);

    return round($finalPrice, 2);
}