<div align="center">
<table border="0">
  <tr>
    <td width="250px" rowspan="5"><img src="/public/images/<?=$_SESSION["file"] ?>" width="250px" alt="Письма мастера дзен"></td>
    <td colspan="3" align="center" height="20"><?=$dictMyPage?></td>
  </tr>
  <tr>
    <td width="20px"></td>
    <td width="100px" height="30">
        <?=$dictName?>:
    </td>
    <td  width="250px">
        <?=$_SESSION["name"]?>
    </td>
  </tr>
  <tr>
    <td></td>    
    <td height="20">Email:</td>
    <td><?=$_SESSION["email"]?></td>
  </tr>
  <tr>
    <td></td>    
    <td height="20"><?=$dictCreate?>:</td>
    <td><?=$_SESSION["timestamp"]?></td>
  </tr>
  <tr>
    <td></td>    
    <td></td>
    <td></td>
  </tr>
</table>
<div>