<?php 
/*******************************************************************************
 *******************************************************************************
 **                                                                           **
 **                                                                           **
 **  Copyright 2015-2017 JK Technosoft                  					  **
 **  http://www.jktech.com                                           		  **
 **                                                                           **
 **  ProActio is free software; you can redistribute it and/or modify it      **
 **  under the terms of the GNU General Public License (GPL) as published     **
 **  by the Free Software Foundation; either version 2 of the License, or     **
 **  at your option) any later version.                                       **
 **                                                                           **
 **  ProActio is distributed in the hope that it will be useful, but WITHOUT  **
 **  ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or    **
 **  FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License     **
 **  for more details.                                                        **
 **                                                                           **
 **  See TNC.TXT for more information regarding the Terms and Conditions    **
 **  of use and alternative licensing options for this software.              **
 **                                                                           **
 **  A copy of the GPL is in GPL.TXT which was provided with this package.    **
 **                                                                           **
 **  See http://www.fsf.org for more information about the GPL.               **
 **                                                                           **
 **                                                                           **
 *******************************************************************************
 *******************************************************************************
 *
 * {program name}
 *
 * Known Bugs & Issues:
 *
 *
 * Author:
 *
 *	JK Technosoft
 *	http://www.jktech.com
 *	August 11, 2015
 *
 *
 * History:
 *
 */

include('header.php');
include('sqlconnect.php');
$query=mysqli_query($connect,"select dbuid,dbname from configureddb");?>
<div class="container">
<div class="row">
	    <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">     
	<div class="form-group col-lg-3 pull-right">
	<select class="form-control col-lg-3" id="sel1" name="sel1">
 <?php while($row=mysqli_fetch_assoc($query))
		{
		echo     "<option value='" . $row['dbuid'] . "'>" . $row['dbname'] . "</option>";
		}
		?>
        
      </select>  
	  </div><p>Database Area Status</p></h3>
  </div>
  <div class="panel-body">
<table data-toggle="table"
       data-url="ajax/databaseareastatus.php"
	   data-query-params="queryParams"
       data-sort-order="desc"
	   data-show-refresh="true"
	   data-pagination="true"
	   data-search="true"
	   data-show-export="true"
	   data-show-columns="true"
	     id="tab1"
	>
    <thead>
    <tr>
        <th data-field="_AreaStatus-Areaname" 
            >
              Area Name
        </th>
        <th data-field="_AreaStatus-Areanum" 
            >
              Area Number
        </th>
        
		 <th data-field="_AreaStatus-Extents" 
          >
               Total Extents
        </th>   
		<th data-field="_AreaStatus-Totblocks" 
          >
               Area Size
        </th>   
		<th data-field="_AreaStatus-Hiwater" 
          >
             Used (%)
        </th>   
		<th data-field="_AreaStatus-Freenum" 
          >
               Used Space  
        </th>       
		
    </tr>
    </thead>
</table>
</div>
</div></div>
</div>
<script>
var selected= $("#sel1 option:selected").val();
$('#sel1').on('change', function() {
 selected = this.value;
 $('#tab1').bootstrapTable('refresh', {silent: false});
});
$('#tab1').bootstrapTable({
    formatNoMatches: function () {
         return '<img src="images/databaseinaccessible.gif"></img>';
    },
	formatLoadingMessage: function () {
         return '<img src="/images/connecting.gif"></img>';
    }
});
function queryParams() {
    return {
        dbuid: selected
    };
}
</script>
