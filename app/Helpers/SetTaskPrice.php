<?php
    function setTaskPrice($catRating, $catPrice,
                          $userRating, $urgency)
    {
        $priceMultiplier = ($urgency == 3) ? 1 : (($urgency == 2) ? 1.1 : 1.2);
        if( (($catRating - 200) < $userRating) and (($catRating + 200) > $userRating) ) {
            return ceil($catPrice * $priceMultiplier);
        }
        elseif( ($catRating / $userRating) < 0.5){
            return ceil($catPrice * 0.3 * $priceMultiplier);
        }
        elseif( ($catRating / $userRating) < 1) {
            return ceil($catPrice * round(($catRating / $userRating) * 0.75, 1) * $priceMultiplier);
        }
        else{
            return intval(ceil(1.25 * $catPrice) * $priceMultiplier);
        }
    }
