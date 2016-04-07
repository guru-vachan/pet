
 
<?php
//include("session_config.php");
//include("config.php");
include_once("../fckeditor/fckeditor_php4.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html><head><TITLE>Control Panel</TITLE>
<script language="javascript" type="text/javascript">
function validate()
            {
            if(document.getElementById("page_title").value=="")
            {
            alert("Page title can not be Blank !!");
            document.getElementById("page_title").focus();
            return false;
            }
                        return true;
    }
</script>
<META http-equiv=Content-Type content="text/html; charset=windows-1252">
<LINK href="Control%20Panel_files/cpstyle.css" type=text/css rel=stylesheet>
<META content="MShtml 6.00.6000.16809" name=GENERATOR>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style7 {
            color: #00CCFF;
            font-size: 24px;
}
.style8 {color: #FFFFFF}
.style9 {
            color: #333333;
            font-weight: bold;
}
.style10 {
            color: #666666;
            font-weight: bold;
}
-->
</style>
</head>
<body>
<TABLE height="100%" cellSpacing=0 cellPadding=0 width=800 align=center  border=1 bordercolor="#00CCFF">
  <Tbody>
  <TR>
    <TD vAlign=top align=middle><table cellspacing=0 cellpadding=0 width="100%" align=center border=0>
      <tbody>
        <tr>
          <td class=headingtext valign=top align=left width="100%" bgcolor=#ffffff height="60px">
                          <div class="style10" style="padding-left:15px; padding-top:15px"><u>Web
            Administrator - Conrol Panel</u></div></td>
        </tr>
        <tr>
          <td align="center">
                            <span class="style1">
                                    <a href="home.php">Home</a> |
                                    <a href="content.php">Contents</a> |
                            <a href="Password_change.php">Change Password</a> |
                            <a href="index.php?qs=logout">Logout</a></span></td>
        </tr>
                             <tr>
          <td valign=center align=middle width="100%" bgcolor=#ffffff>            </td>
        </tr>
                        <tr>
          <td width="100%" bgcolor="#999999" height="22px" align="left"><span class="style7">Manage Contents</span></td>
                                    <tr>
        <tr>
          <td class=smalltext valign=top align=right width="100%" bgcolor=#ffffff height=550 >
 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right" style="padding-top:10px; padding-right:10px; padding-bottom:10px"><table width="10%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
                <tr bgcolor="#999999">
                  <td width="46%" align="center">Add</td>
                  <td width="54%" align="center">Show</td>
                </tr>
                <tr bgcolor="#CCCCCC">
                  <td align="center"><a href="add_new.php"><img src="adminimages/add.png" width="25" height="25" border="0"></a></td>
                  <td align="center"><a href="content.php"><img src="adminimages/view.png" width="25" height="25" border="0"></a></td>
                </tr>
              </table></td>
            </tr>
          </table>
                          <?php
                          if($_REQUEST["Submit"]=="  Add  ")
                          {
                                                $sql="select page_title from content where page_title='".$_REQUEST["page_title"]."'";
                                                $row=mysql_query($sql);
                                                if(mysql_num_rows($row)>0)
                                                {
                                                $msg="This Page is already exist";
                                                }
                                                else
                                                {
                                                            $title=$_REQUEST["page_title"];
                                                            $details=str_replace("'"," ",$_REQUEST["message"]);
                                                            $str="insert into content(page_title,details)values('".$title."','".$details."')";
                                                            mysql_query($str);
                                                            $msg="Saved Successfully";
                                                }
                          }
                          ?>
                          <form action="add_new.php" method="post" name="Add New" onSubmit="return validate();">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#666633"></tr>
            <tr bgcolor="#666633">
              <td colspan="2" height="25"><span class="heading3 style8"><strong>Basic Details</strong></span></td>
            </tr>
            <tr bgcolor="#FFCCFF">
              <td width="24%" height="30"><span class="style9">Page Title</span></td>
              <td width="76%"><input type="text" name="page_title" size="96"></td>
            </tr>
            <tr bgcolor="#666633">
              <td colspan="2" height="20"><span class="heading3 style8"><strong>Descriptive details</strong></span></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                                      <?php
 
                        $sBasePath = "../fckeditor/";
                        $oFCKeditor = new FCKeditor('message') ;
                        $oFCKeditor->BasePath = $sBasePath ;
                        $oFCKeditor->ToolbarSet = "Basic" ;
                        //$oFCKeditor->Value =$rs["message"];
                        $BOX_BLOG_RTE=$oFCKeditor->Createhtml();
                        echo $BOX_BLOG_RTE;
                        ?></td>
            </tr>
                                    <tr bgcolor="#666633">
              <td colspan="2" align="center"><font color="#FF0000"><strong><?php echo $msg; ?></strong></font></td>
            </tr>
                                    <tr bgcolor="#FFFFFF">
              <td colspan="2" align="center"><input type="submit" name="Submit" value="  Add  " />
                <input name="Button" type="button" class="button" id="Submit" onClick="window.location='content.php';" value="Cancel" /></td>
            </tr>
          </table>
                          </form>
            <tr>
                                    <tr>
          <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="smalltext">Content Management System 2012. All Rights Reserved.</td>
            </tr>
          </table></td>
                                    <tr>        </tr>
      </tbody>
    </table>
 
            </TD>
  </TR></Tbody></TABLE>
</body>
</html>