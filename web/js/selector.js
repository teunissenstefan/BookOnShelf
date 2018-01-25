function GetAuthor(){
    var shownVal= document.getElementById("inputAuthor").value;
    if(shownVal){
        var value2send=document.querySelector("#auteurLijst option[value='"+shownVal+"']").dataset.value;
        if(value2send){
            document.getElementById("inputAuthor").value = value2send;
            return true;
        }
    }
    return true;
}