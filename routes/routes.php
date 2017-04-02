<?php
/**
 * Chinmaya Registration Sevak (http://www.chinmayacloud.com)
 *
 * @link      https://github.com/chinmaya.regsevak
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 * @license   https://github.com/chinmaya.regsevak/blob/master/licenses/UserFrosting.md (MIT License)
 */

$app->group('/chinmaya', function () {
    $this->get('/dashboard','UserFrosting\Sprinkle\Chinmaya\Controller\ChinmayaAdminController:pageDashboard');
});