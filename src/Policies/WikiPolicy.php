<?php

namespace GrassFeria\StarterkidWiki\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use \GrassFeria\StarterkidWiki\Models\Wiki;
use GrassFeria\Starterkid\Traits\EditorPolicyTrait;
use GrassFeria\Starterkid\Traits\OnlyUserRecordPolicyTrait;;

class WikiPolicy
{
   
     use EditorPolicyTrait;

   

    
}
