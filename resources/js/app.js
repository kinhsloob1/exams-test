require('./bootstrap');
const $ = window.$ = require('jquery');

$('.delete, .edit').on('click', async function(e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  const self = $(this);
  const closestRoot = self.closest('.root');
  const id = closestRoot.data('id');

  let url = '/' + closestRoot.data('route') + `/${id}`;

  if(self.hasClass('delete')){
    try{
      const {data, status} = await window.axios({
        method: 'delete',
        url,
        responseType: 'json',
        validateStatus: function (status) {
          return status < 500;//status >= 200 && status < 300; // default
        },
      });

      if(status === 200){
        setTimeout(() => {
          window.location.reload(true);
        }, 2000);

        return alert(data.message);
      }

      alert(data.message || 'An error occurred');
    }catch(e){
      alert('a server error occurred');
    }
  }else{
    url = `${url}/edit`;
    window.location.href = url;
  }
});

$('.submit').on('click', async function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  
  const form = $(this).closest('form');
  const formData =  form.serialize();
  const action = form.data('action');
  const id = form.data('id');

  let url = form.data('route');
  let method = 'post';

  switch(action){
    case 'edit':
      url = `${url}/${id}`
      method= 'patch';
      break;
  }

  url = `/${url}`;
  try{
    const {data, status} = await window.axios({
      method,
      url,
      data: formData,
      responseType: 'json',
      validateStatus: function (status) {
        return status < 500;//status >= 200 && status < 300; // default
      },
    });

    if(status === 200){
      setTimeout(() => {
        window.history.back();
      }, 2000);

      return alert('data saved succesfully');
    }

    alert(data.message || 'An error occurred');
  }catch(e){
    alert('a server error occurred');
  }
})


