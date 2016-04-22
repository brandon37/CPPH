 
    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    
    <script src="<?=base_url()?>assets/js/bootstrap.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url()?>assets/js/plugins/morris/raphael.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/morris/morris.min.js"></script>
   	<script type="text/javascript">   	

        
       	$(function(){


       		$('#createUserModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body input').val(recipient)
            })


            $('#editUserModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever')
                // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body input').val(recipient)  
            })


            $('.confirmationDeleteUser').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });

            $('.confirmationDeleteDepartment').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });

            $('.confirmationDeleteSector').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });            
            

            $('.confirmationDeleteinvoice').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });

            $('.confirmationDeleteProject').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });
            $('.confirmationDeleteInProject').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });
            

            $('.confirmationDeleteordershopping').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });

            $('.confirmationDeleteClient').on('click', function (e) {
                e.preventDefault();
                var result = confirm('Are you sure?');
                if(result){
                    window.location = $(this).attr("href"); 
                }
             });
          
       	});        
    </script>

</body>

</html>