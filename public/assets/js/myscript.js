$('.btn-delete').on('click',function(e){
    e.preventDefault();
	  const action = $(this).attr('action');
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $(this).parents('.formDelete').submit();
      }
    });
  });

  $('.sort-select').on('change',function(){
    let sort = $('.sort-select').val();
    if (sort !== '') {
        this.form.submit();
    }
  });