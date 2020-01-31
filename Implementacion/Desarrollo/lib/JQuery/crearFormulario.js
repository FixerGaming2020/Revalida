// $(document).ready(function () {



//   $(".next").click(function () {

//     if ($('#tool-1').prop('checked')) {
//       var tool = $("#tool-1").val();
//     }
//     if ($('#tool-2').prop('checked')) {
//       var tool = $("#tool-2").val();
//     }
//     if ($('#tool-3').prop('checked')) {
//       var tool = $("#tool-3").val();
//     }

//     // alert(tool);
//     $.ajax({
//       type: "POST",
//       url: "./formulario.php",
//       data: {
//         tool: tool
//       },
//       success: function (data) {

//         console.log(data);

//         $('#contenido2').html(data[0]['resultado']);
//       },
//       error: function (data) {
//         console.log(data);
//       }
//     });

//   });

// });