 <?php

// app/Helpers/RedirectHelper.php

namespace App\Helpers;

class RedirectHelper
{
    public static function redirect($success)
    {
        return redirect(route($success));
    }


}
