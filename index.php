if(isset($_SESSION['username'])) {
//Membre connecté : Renvoi vers Espace membre
        header ('Location: member.php');
        exit();
    }
else {
	//Membre non connecté : Renvoi vers le site public
	$erreur="";
	$msg="";

	ini_set('display_errors','off');
	require('config.php');

		$requete = $bdd->prepare( "SELECT count(*) as nbre FROM ANNONCES WHERE 1=1 LIMIT 2000");
		if ($requete->execute()) {
			$result=$requete->fetch();
			$nbannonces=$result['nbre'];
			$erreur="no_errors";
		}
		else
			$erreur='Erreur technique 002'; //impossible d'executer la requête SELECT

	$requete->closecursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Bouche@Oreille</title>

  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

  <!-- style css -->
  <link rel="stylesheet" href="css/sk-style.css">
  <style type="text/css">
  .sk-navbar{
    padding: 0.5px;
    background-color:#22262A;    /*343a40;*/
  }
  </style>
</head>

<body>
<!-- loader  -->
<div class="loader_bg">
  <div class="loader"><img src="images/loading.gif" alt="#" /></div>
</div>
<!-- end loader --> 

<!-- Header-->
<nav class="navbar navbar-expand-lg navbar-dark p-navbar">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  <a class="navbar-brand nav-link mr-0 mr-md-2" href="#" aria-label="Bouche@Oreille">
  <?php include("svg/logo.svg"); ?>
  </a>
  <div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#searchsection" alt="Trouver">Trouver une annonce</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#fonctionnement">Comment ça marche ?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://facebook.com/" alt="Facebook">
            <svg class="svg-icon" viewBox="0 0 20 20">
              <title>Facebook</title>
              <path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path>
            </svg>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://twitter.com/" alt="Twitter">
            <svg class="svg-icon">
              <title>Twitter</title>
              <path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
            </svg>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://instagram.com/" alt="Instagram">
            <svg class="svg-icon" viewBox="0 0 20 20">
              <title>Instagram</title>
             <path fill="none" d="M14.52,2.469H5.482c-1.664,0-3.013,1.349-3.013,3.013v9.038c0,1.662,1.349,3.012,3.013,3.012h9.038c1.662,0,3.012-1.35,3.012-3.012V5.482C17.531,3.818,16.182,2.469,14.52,2.469 M13.012,4.729h2.26v2.259h-2.26V4.729z M10,6.988c1.664,0,3.012,1.349,3.012,3.012c0,1.664-1.348,3.013-3.012,3.013c-1.664,0-3.012-1.349-3.012-3.013C6.988,8.336,8.336,6.988,10,6.988 M16.025,14.52c0,0.831-0.676,1.506-1.506,1.506H5.482c-0.831,0-1.507-0.675-1.507-1.506V9.247h1.583C5.516,9.494,5.482,9.743,5.482,10c0,2.497,2.023,4.52,4.518,4.52c2.494,0,4.52-2.022,4.52-4.52c0-0.257-0.035-0.506-0.076-0.753h1.582V14.52z"></path>
            </svg>
          </a>
        </li>
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="nav-item">
        <a title="deposer une annonce" class="nav-link" href="" data-toggle="modal" data-target="#loginmodal">
          <div align="center">
            <svg class="svg-icon" viewBox="0 0 20 20">
              <path d="M17.33 10.67h-4v-4a1.33 1.33 0 10-2.66 0v4h-4a1.33 1.33 0 100 2.66h4v4a1.33 1.33 0 102.66 0v-4h4a1.33 1.33 0 100-2.66z"></path>
              <path d="M21.6 0H2.4A2.41 2.41 0 000 2.4v19.2A2.41 2.41 0 002.4 24h19.2a2.41 2.41 0 002.4-2.4V2.4A2.41 2.41 0 0021.6 0zm0 20.4a1.2 1.2 0 01-1.2 1.2H3.6a1.2 1.2 0 01-1.2-1.2V3.6a1.2 1.2 0 011.2-1.2h16.8a1.2 1.2 0 011.2 1.2v16.8z">
              </path>
            </svg>
            <br><span data-text="Deposer une annonce" data-reactid="48">Deposer une annonce</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a title="Mes messages" class="nav-link" href="" data-toggle="modal" data-target="#loginmodal">
          <div align="center">
            <svg class="svg-icon" viewBox="0 0 20 20">
              <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
            </svg>
            <br><span data-text="Messages" data-reactid="48">Messages</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a title="Mes favoris" class="nav-link" href="" data-toggle="modal" data-target="#loginmodal">
          <div align="center">
            <svg class="svg-icon" viewBox="0 0 20 20">
              <path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61"></path>
            </svg>
            <br><span data-text="Favoris" data-reactid="48">Favoris</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a title="Mon compte" class="nav-link" href="" data-toggle="modal" data-target="#loginmodal">
          <div align="center">
            <svg class="svg-icon" viewBox="0 0 20 20">
                <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path>
            </svg>
            <br><span data-text="Compte" data-reactid="48"><?php if (isset($_SESSION['username'])) echo $_SESSION['username']; else echo "Se connecter"?></span>
          </div>
        </a>
      </li>
    </ul>
  </div>
  <a class="btn btn-menu" href="register.php">Devenir membre</a>
  <button type="button" class="btn btn-sk-primary" data-toggle="modal" data-target="#loginmodal">Connexion</button>
</nav>
<!-- end Header-->

  <!--Loginmodal -->
  <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" name="loginform" id="loginformmodal" action="login_ctrl.php">
              <div class="error" id="loginm_err"></div>
                <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email*" maxlength="50" required>
                    <!-- Error -->
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" data-minlength="8" data-error="Saisissez au moins 8 caractères" placeholder="Mot de passe*" maxlength="20" required>
                    <!-- Error -->
                  <div class="help-block with-errors"></div>
                  <a href="mdpoublie.php">Mot de passe oublié ?</a>
              </div>
              <div class="form-group text-center">
                  <button type="submit" id="connexionm" value="Connexion" class="btn btn-sk-primary btn-block">Se connecter</button>
              </div>
            </form>
            <hr>Vous ne posssédez pas de compte ?</hr>
            <div class="form-group text-center">
                <button type="submit" onclick="document.location.href='register.php'" class="btn btn-secondary btn-block" id="inscription">Devenir membre</button>
            </div>
      </div>
      </div>
    </div>
  </div>
  <!--Loginmodal-->

	<!--Searchsection -->
	<?php include("p-search.php"); ?>
	<!--End Searchsection -->

  <!-- footer -->
  <?php include("p-explain.php");?>
  <!-- end footer -->

  <!-- footer -->
  <?php include("p-footer.php");?>
  <!-- end footer -->

<!-- Javascript files--> 
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<script src="js/plugin.js"></script> 

<script type="text/javascript">

  //Init sections
  $("#msg_err").empty();
  $("#msg_success").empty();
  $("#messagesection").hide();
  $("#resultsection").hide();
  $("#m-createitem").hide();
  $("#m-messages").hide();
  $("#m-favoris").hide();
  $("#m-compte").hide();

  function ga(divId)
  {
    console.log(divId);
    $("#msg_err").empty();
    $("#msg_success").empty();
    $("#messagesection").hide();
    $("#searchsection").hide();
    $("#resultsection").hide();
    $("#m-createitem").hide();
    $("#m-messages").hide();
    $("#m-favoris").hide();
    $("#m-compte").hide();

    $(divId).show();
  };

setTimeout(function () {
  $('.loader_bg').fadeToggle();
}, 900);

function BtnLoading(elem) {
  console.log("BtnLoading");
    $(elem).attr("data-original-text", $(elem).html());
    $(elem).prop("disabled", true);
    $(elem).html('<i class="spinner-border spinner-border-sm"></i> Loading...');
};

function BtnReset(elem) {
  console.log("BtnReset");

    $(elem).prop("disabled", false);
    $(elem).html($(elem).attr("data-original-text"));
};

$.validator.setDefaults({
  submitHandler: function () {
    alert("submitted!");
  }
});

 
// Document is ready 
$(document).ready(function () {
  // Code By Webdevtrick ( https://webdevtrick.com )

  //JS for the createitemform
  function readFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
   
      reader.onload = function(e) {
        var htmlPreview =
          '<img width="140" src="' + e.target.result + '" />' +
          '<p>' + input.files[0].name + '</p>';
        var wrapperZone = $(input).parent();
        var previewZone = $(input).parent().parent().find('.preview-zone');
        var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
   
        wrapperZone.removeClass('dragover');
        previewZone.removeClass('hidden');
        boxZone.empty();
        boxZone.append(htmlPreview);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function reset(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }
  $(".dropzone").change(function() {
    readFile(this);
  });
  $('.dropzone-wrapper').on('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
  });
  $('.dropzone-wrapper').on('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
  });
  $('.remove-preview').on('click', function() {
    var boxZone = $(this).parents('.preview-zone').find('.box-body');
    var previewZone = $(this).parents('.preview-zone');
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone);
  });
  $('#createitemform').validator();
  $("#createitemform").on('keyup','INPUT' ,function(e){
    e.preventDefault();
    $("#msg_err").empty();
  });
  $('#createitemform').validator().on('submit', function (e) {
    console.log("submit");
    if (e.isDefaultPrevented()) {
      // handle the invalid form...
      console.log("passage1");
    } 
    else
    {
      // everything looks good!
      e.preventDefault();
      BtnLoading('#creationitem');
      var $form = $(this);
      var fd = new FormData();
      $.ajax({
        type: 'POST',
        url: $form.attr('action'),
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
          console.log("sucess");
          if (data[0]=="no_errors"){
            $("#msg_success").empty();
            $("#msg_success").append(data[1]);
            $("#messagesection").show();
            $("#m-createitem").hide();
          }
          else {
            $("#msg_err").empty();
            $("#msg_err").append(data[1]);
            $("#messagesection").show();
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log("erreur");
          $("#msg_err").empty();
          $("#msg_err").append(XMLHttpRequest.responseText);
          $("#messagesection").show();
        },
        complete : function(resultat, statut, erreur){
          console.log("complete");
          BtnReset('#creationitem');
        }
      });
    }
  })
  //End JS for the createitemform

  //JS for the searchform
  $("#searchsection").on('change','INPUT, SELECT' ,function(e){
    e.preventDefault();
    var service= $("#listeservice").val();
    var ville= $("#listeville").val();
    console.log('change sur #rechercheannonce:'+'service:'+service+'ville:'+ville);
     $.ajax({
      type:"POST",
        url: "getnbannonces.php",
        data: {ville: ville, service: service},
        success:function(html){
        console.log('Fin de traiement formulaire');
        //$("#rechercheannonce").val(html);
        $("#rechercheannonce").text(html);
        }
    })
  });
  $("#searchform").on('submit', function(e){
    e.preventDefault();
    BtnLoading('#rechercheannonce');
    var $form = $(this);
    console.log('submit#searchform:'+$form.serialize());
    $.ajax({
      type:"POST",
      //url: "find.php",
      url: $form.attr('action'),
      data: $form.serialize(),
      success:function(html){
      console.log('success');
      $("#resultsection").empty();
      $("#resultsection").append(html);
      $("#resultsection").show();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log("erreur");
        console.log(XMLHttpRequest);
        console.log(textStatus);
        console.log(errorThrown);
        $("#error_msg").empty();
        $("#error_msg").append(XMLHttpRequest.responseText);
        },
      complete : function(resultat, statut, erreur){
        console.log("complete");
        BtnReset('#rechercheannonce');
      }
    })
  });
  //End JS for the searchform

  //JS for the loginform
  $('#loginform').validator();
  $("#loginform").on('keyup','INPUT' ,function(e){
    console.log("keyup");
    e.preventDefault();
    $("#login_err").empty();
  });
  $('#loginform').validator().on('submit', function (e) {
    console.log("submit");
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
        console.log("passage1");
    } 
    else
    {
        // everything looks good!
        e.preventDefault();
      BtnLoading('#connexion');
      var $form = $(this);
      $.ajax({
        type: 'POST',
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType: "json",
        success: function(data) {
            console.log("success");
          if (data[0]=="no_errors"){
            console.log("Accès espace memebre")
            window.location.href="member.php";
          }
          else {
            $("#login_err").empty();
            $("#login_err").append(data[0]);
          }
        },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("erreur");
                console.log(XMLHttpRequest.responseText);
          $("login_err").empty();
          $("login_err").append(XMLHttpRequest.responseText);
              },
        complete : function(resultat, statut, erreur){
            console.log("complete");
            BtnReset('#connexion');
        }
      });
    }
  });
  //End JS for the loginform

  //JS for the loginformmodal
  $('#loginformmodal').validator();
  $("#loginformmodal").on('keyup','INPUT' ,function(e){
    e.preventDefault();
    $("#loginm_err").empty();
  });
  $('#loginformmodal').validator().on('submit', function (e) {
    console.log("submit");
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
        console.log("passage1");
    } 
    else
    {
      // everything looks good!
      e.preventDefault();
      BtnLoading('#connexionm');
      var $form = $(this);
      $.ajax({
        type: 'POST',
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType: "json",
        success: function(data) {
          console.log("sucess");
          if (data[0]=="no_errors"){
            console.log("Accès espace memebre")
            window.location.href="member.php";
          }
          else {
            $("#loginm_err").empty();
            $("#loginm_err").append(data[0]);
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log("erreur");
          $("#loginm_err").empty();
          $("#loginm_err").append(XMLHttpRequest.responseText);
        },
        complete : function(resultat, statut, erreur){
            console.log("complete");
            BtnReset('#connexionm');
        }
      });
    }
  });
  //End JS for the loginformmodal

});
</script>

</body>
</html>
<?php
}
?> 
