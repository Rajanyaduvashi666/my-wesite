<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <style>
  .holder
	{
	  width: 60%;
    margin: auto;
	}
  .box
	{
	   border:1px solid #000;
	   height: 100px;
	   text-align: center;
     padding: 5%;
	}

	.row-span
	{
    border: 1px solid #000;
    width: 50%;
    margin: auto;
    margin-top: 2%;
	}

	.col-block
	{
		border-right: 1px solid #000;
		cursor: pointer;
		font-weight: bold;
	}

  </style>
</head>
<body>

<div class="container-fluid">
 
  <div class="container-fluid">
    <!-- Control the column width, and how they should appear on different devices -->
    <div class="row">
		<div class="holder row">
		    <?php  
		    $a=1;
		    $totRow=6;
		    $totCol=6;
		    for($row=1;$row<=$totRow;$row++)
		    {
		    	for($col=1;$col<=$totCol;$col++)
		      {
		    	?>
               <div class="col-sm-2 box rowCls<?php echo $row; ?> colCls<?php echo $col; ?>" id="rowId_<?php echo $row; ?>_<?php echo $col; ?>">
			        	<?php 
                 if(($row==1) && ($col==3))
                 {
                  ?>
                      <label><i class="fa fa-user" style="font-size:40px"></i></label>
                 	<?php
                 }
                 else
                 {
                 	?>
                      <label></label>
                 	<?php
                 }
			        	?>

			        </div>
		    	<?php
		    	    $a++;
		        }
		    }
		    ?>
		  <div style="clear:both"></div>

		  <div class="row col-sm-12 row-span">
        <div class="col-sm-2 col-block text-center colNo" id="colno_1" onclick="moveTo(1)">1</div>
        <div class="col-sm-2 col-block text-center colNo" id="colno_2" onclick="moveTo(2)">2</div>
        <div class="col-sm-2 col-block text-center colNo" id="colno_3" onclick="moveTo(3)">3</div>
        <div class="col-sm-2 col-block text-center colNo" id="colno_4" onclick="moveTo(4)">4</div>
        <div class="col-sm-2 col-block text-center colNo" id="colno_5" onclick="moveTo(5)" style="border-right: 0px;">5</div>
		  </div>
		  <br/>
		  <div style="clear:both"></div>
		  <div class="row col-sm-12 row-span">
        <div class="col-sm-3 col-block text-center pos" id="pos_left" onclick="moveSide('left')">Left</div>
        <div class="col-sm-3 col-block text-center pos" id="pos_top" onclick="moveSide('top')">Top</div>
        <div class="col-sm-3 col-block text-center pos" id="pos_right" onclick="moveSide('right')">Right</div>
        <div class="col-sm-3 col-block text-center pos" id="pos_bottom" onclick="moveSide('bottom')" style="border-right: 0px;">Bottom</div>
		  </div>
		  <div class="row" style="margin-top: 1%;margin-left: 0%;">
			  <input type="hidden" value="1" id="current_row">
			  <input type="hidden" value="3" id="current_col">
			  <input type="hidden" value="right" id="move_side">
			  <input type="hidden" value="3" id="move_to">
			  <button type="button" onclick="getdata()" class="btn btn-success" onclick="">Submit</button>
			</div>
		  </div>
    </div>
	
  </div>
</div>

<script>

	function moveTo(bl)
	{
    $('#move_to').val(bl);
    $('.colNo').attr('style','color:black');
    $('#colno_' + bl).attr('style','color:red');
	}

	function moveSide(bl)
	{
    $('#move_side').val(bl);
    $('.pos').attr('style','color:black');
    $('#pos_' + bl).attr('style','color:red');
	}

  function getdata()
  {
  	var cr=$('#current_row').val();
  	var cc=$('#current_col').val();
  	var tr=6;
  	var tc=6;
  	var rr=parseInt(tr) -  parseInt(cr);
  	var rc=parseInt(tc) -  parseInt(cc);

  	var ms=$('#move_side').val();
  	var mt=$('#move_to').val();
  	
  	switch(ms)
  	{
  		case "top":
         if(cr>mt)
         {
         	 var mtr=parseInt(cr) -  parseInt(mt);
         	 var nid="rowId_" + mtr + '_' + cc;
         	 var oid="rowId_" + cr + '_' + cc;
         	 var htmlDt='<label><i class="fa fa-user" style="font-size:40px"></i></label>';
         	 $('#'+nid).html(htmlDt);
         	 $('#'+oid).html('');
         	 $('#current_row').val(mtr);
         	 $('#current_col').val(cc);
         }
         else
         {
         	 alert("Sorry , there is no space to move");
         }
  		break;

  		case "bottom":
  		   var mtr=parseInt(mt) +  parseInt(cr);
         if(mtr<=tr)
         {
         	 var mtr=parseInt(mt) +  parseInt(cr);
         	 var nid="rowId_" + mtr + '_' + cc;
         	 var oid="rowId_" + cr + '_' + cc;
         	 var htmlDt='<label><i class="fa fa-user" style="font-size:40px"></i></label>';
         	 $('#'+nid).html(htmlDt);
         	 $('#'+oid).html('');
         	 $('#current_row').val(mtr);
         	 $('#current_col').val(cc);
         }
         else
         {
         	 alert("Sorry , there is no space to move");
         }
  		break;

  		case "left":
         if(cc>mt)
         {
         	 var mtr=parseInt(cc) -  parseInt(mt);
         	 var nid="rowId_" + cr + '_' + mtr;
         	 var oid="rowId_" + cr + '_' + cc;
         	 var htmlDt='<label><i class="fa fa-user" style="font-size:40px"></i></label>';
         	 $('#'+nid).html(htmlDt);
         	 $('#'+oid).html('');
         	 $('#current_row').val(cr);
         	 $('#current_col').val(mtr);
         }
         else
         {
         	 alert("Sorry , there is no space to move");
         }
  		break;

  		case "right":
         var mtr=parseInt(mt) +  parseInt(cc);
         if(mtr<=tr)
         {
         	 var mtr=parseInt(mt) +  parseInt(cc);
         	 var nid="rowId_" + cr + '_' + mtr;
         	 var oid="rowId_" + cr + '_' + cc;
         	 var htmlDt='<label><i class="fa fa-user" style="font-size:40px"></i></label>';
         	 $('#'+nid).html(htmlDt);
         	 $('#'+oid).html('');
         	 $('#current_row').val(cr);
         	 $('#current_col').val(mtr);
         }
         else
         {
         	 alert("Sorry , there is no space to move");
         }
  		break;
  	}
  }
</script>
</body>
</html>
