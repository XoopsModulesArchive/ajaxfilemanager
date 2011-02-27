function selectFile(url)
{
      window.opener.document.getElementById(elementId).value = window.opener.document.getElementById(elementId).value + '[img]' + url + '[/img]';
      window.close() ;
 

}



function cancelSelectFile()
{
  // close popup window
  window.close() ;
}

