<!-- END OF PAGE CONTENT (MAIN) -->
</div>

<!-- <footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 2.4.0
	</div>
	<strong>Copyright © 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
	reserved.
</footer> -->

</div>
<div class="control-sidebar-bg"></div>
</div>

<!-- FOOTER -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<!-- <script src="CDNs/dashboard/jquery/dist/jquery.validate.min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script
src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.js"></script>
<script src="CDNs/dist/js/adminlte.min.js"></script>

<!-- Datatables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<!--<script type="text/javascript">
	
	$(document).ready(function(){

		function load_unseen_notification(view = '')
		{
			$.ajax({
				url:"AJAX/loadNotifs.php",
				method:"POST",
				data:{view:view},
				dataType:"json",
				success:function(data)
				{
					$('.notifsMenu').html(data.notification);
					if(data.unseen_notification > 0)
					{
						$('.count').html(data.unseen_notification);
					}
				}
			});
		}

		load_unseen_notification();

		$(document).on('click', '.notifsToggle', function(){
			$('.count').html('');
			load_unseen_notification('yes');
		});

		setInterval(function(){ 
			load_unseen_notification();; 
		}, 5000);

	});
</script>-->

</body>
</html>