$("#btnSignup").click(function(e){
    var data = new FormData();
    data.append("option", 1);
    fetch("view/template.php", {
        method: "POST",
        body: data
    })
})

$("#btnLogin").click(function(e){
    var data = new FormData();
    data.append("option", 2);
    fetch("view/template.php", {
        method: "POST",
        body: data
    })
})