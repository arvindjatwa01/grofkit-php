<?php $strPageTitle = "Dashboard";
include_once 'header.php';


?>

<!-- Main content -->

<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<?php include_once 'sidebar.php' ?>

		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-default">
				<div class="page-header-content">
					<div class="page-title">
						<h4> <span class="text-semibold">Dashboard</span></h4>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>


				</div>

				<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_ADMIN_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
						<li><a href="<?php echo SITE_ADMIN_URL ?>">Dashboard</a></li>

					</ul>


				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">

				<div class="row">
					<div class="col-lg-4">
                       
						<!-- Members online -->
						<div class="panel bg-teal-400">
						    
							<div class="panel-body text-center">
							    	<h4>Total Order</h4>
							<?php
								global $dbh;
								 $TotalOrdersql = 'SELECT COUNT(*) AS totalorder FROM `order`';
								 $TotalOrderRes =$dbh->query($TotalOrdersql);
								 $TotalOrderRow = $TotalOrderRes->fetch();
								?>

								<h5 class="no-margin"><?php echo $TotalOrderRow['totalorder']; ?></h5>
								
							<!--	<div class="text-muted text-size-small"></div>-->
							</div>
						</div>
						<!-- /members online -->

					</div>


					<div class="col-lg-4">

						<!-- Today's revenue -->
						<div class="panel bg-blue-400">
							<div class="panel-body text-center">
                                    <h4>Total Cancel Order</h4>
								<?php
								global $dbh;
								$CancelOrderSql = 'SELECT COUNT(*) AS totalcancelorder FROM `order` WHERE OrderStatusID=5';
								$CancelOrderRes = $dbh->query($CancelOrderSql);
								$CancelOrderRow = $CancelOrderRes->fetch();



								?>
								<h5 class="no-margin"><?php echo $CancelOrderRow['totalcancelorder']; ?></h5>
								
							</div>

							<div id="today-revenue"></div>
						</div>
						<!-- /today's revenue -->

					</div>
					<div class="col-lg-4">

						<!-- Today's revenue -->
						<div class="panel bg-pink-400">
							<div class="panel-body text-center">
							    <h4>Total Net Order</h4>

								<h3 class="no-margin"><?php echo $TotalOrderRow['totalorder']-$CancelOrderRow['totalcancelorder']; ?></h3>
							</div>

							<div id="today-revenue"></div>
						</div>
						<!-- /today's revenue -->

					</div>

				</div>
				<div class="row">
					<div class="col-lg-6">

						<!-- Members online -->
						<div class="panel bg-orange-400">
							<div class="panel-body text-center">
							    <h4>Order-Cash On Delivery</h4>
								<?php
								global $dbh;
								$OrderCashSql = 'SELECT COUNT(*) AS totaldeliverycash FROM `order` WHERE ord_paymentMethod=0';
								$OrderCashRes = $dbh->query($OrderCashSql);
								$OrderCashRow = $OrderCashRes->fetch();
								?>

								<h3 class="no-margin"><?php echo $OrderCashRow['totaldeliverycash']; ?></h3>
								
								<div class="text-muted text-size-small"></div>
							</div>
						</div>
						<!-- /members online -->

					</div>


					<div class="col-lg-6">

						<!-- Today's revenue -->
						<div class="panel alpha-indigo">
							<div class="panel-body text-center">
                                <h4>Order-Online</h4>
								<?php
								global $dbh;
								$orderOnlineSql = 'SELECT COUNT(*) AS totalOrderOnline FROM `order` WHERE ord_paymentMethod=1';
								$orderOnlineRes = $dbh->query($orderOnlineSql);
								$orderOnlineRow = $orderOnlineRes->fetch();



								?>
								<h3 class="no-margin"><?php echo $orderOnlineRow['totalOrderOnline']; ?></h3>
							</div>

							<div id="today-revenue"></div>
						</div>
						<!-- /today's revenue -->

					</div>

				</div>
				<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered customemessage ">
                                    <thead>
                                        <tr>

                                            <th style="width:10px;" ;text-align:center">
                                                S.No </th>


                                            <th style="text-align:center">Item Name </th>
                                            <th style="text-align:center">Quantity </th>
                                            <th style="text-align:center">Amount(₹)</th>
                                        </tr>
                                    </thead>


                                    <tbody class=" replaceResponse ">
                                        <?php
										$count = 0;
										$strLoadConditions = ' GROUP BY `ordDtl_itemID` ';
										$strFields = "`OrdDtl_itemName`, COUNT(`ordDtl_itemID`) as quantity ,Sum(`OrdDtl_Rate`) as amount ";
										$resSelectCouponList = $class_common->loadMultipleDataByTableName($strLoadConditions, $strFields, '', 1, 'catpagination', 'orderdtl');
										
										if (count($resSelectCouponList) > 0) {
											foreach ($resSelectCouponList as $rowCompany) {
												$count++;
										?>


                                        <tr class="clsparentinformation">


                                            <td style="text-align:center; width:10px">
                                                <?php echo $count; ?> </td>


                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['OrdDtl_itemName']; ?></td>
                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['quantity']; ?></td>

                                            <td style="min-width:30px;text-align:center">
                                                <?php echo $rowCompany['amount']; ?></td>

                                        </tr>




                                        <?php
											}
										}
										?>


                                    </tbody>

                                </table>

                            </div>

                        </div>
				

				<?php include_once 'footer.php'; ?>
			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->

</body>

</html>