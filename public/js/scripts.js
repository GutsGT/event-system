$(window).load(function() {
    document.getElementById("loading").style.display = "none";
    document.getElementById("conteudo").style.display = "initial";
});

if( $(window).width() < 600){
    var editBtns = document.getElementsByClassName('edit-btn');
    for(f = 0; f < editBtns.length; f++){
        editBtns[f].innerHTML = '<ion-icon name="create-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon>';
    }

    var deleteBtns = document.getElementsByClassName('delete-btn');
    for(f = 0; f < deleteBtns.length; f++){
        deleteBtns[f].innerHTML = '<ion-icon name="trash-outline" role="img" class="md hydrated" aria-label="trash outline"></ion-icon>';
    }

    document.getElementsByClassName('actions')[0].style="width:20%; min-width:110px";
    document.getElementsByClassName('participants')[0].innerHTML = 'Part.';

}