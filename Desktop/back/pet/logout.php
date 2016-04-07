<?php
/*
 *  @author programofreak
 *  @email programofreak@progrmofreaks.com
 */

    #========================================================#
    #----------- LOGOUT SCRIPT TO LOGOUT THE USER -----------#
    #========================================================#
    
    session_start();
    
    require_once('fns/auth.php');
    $aobj = new Auth;
    
    $aobj->logout();
?>