<?php   
/**
 * ****************************************************************************
 *  - A Project by Developers TEAM For Xoops - ( http://www.xoops.org )
 * ****************************************************************************
 *  AJAXFILEMANAGER - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *  @copyright  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *  @license    GPL see LICENSE
 *  @package    ajaxfilemanager
 *  @author     Rota Lucio ( lucio.rota@gmail.com )
 *
 *  Version : 1.0 Mon 2012/07/23 14:17:52 : XOOPS Exp $
 * ****************************************************************************
 */

global $pathImageAdmin;
echo "<div align='center'><a href='http://www.xoops.org' target='_blank'>
         <img src='".$pathImageModule."/xoopsmicrobutton.gif' alt='XOOPS' title='XOOPS'></a></div>";
echo "<div class='center small italic pad5'>
          <strong>" . $xoopsModule->getVar('name') . "</strong> " . _AM_AJAXFM_MAINTAINEDBY."
            <a href='IN PROGRESS' title='Visit IN PROGRESS' class='tooltip' rel='external'>IN PROGRESS</a></div>";
xoops_cp_footer();  
