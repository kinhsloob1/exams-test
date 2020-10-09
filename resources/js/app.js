require('./bootstrap');
const $ = window.$ = require('jquery');

$('.delete').on('click', async function(e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  const self = $(this);
  const closestRoot = self.closest('.root');

  try{
    const {data, status} = await window.axios({
      method: 'delete',
      url: closestRoot.data('deleteUrl'),
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
    throw e;
  }
});

$('.submit').on('click', async function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  
  const form = $(this).closest('form');
  const formData =  form.serialize();
  const action = form.data('action');
  const id = form.data('id');

  const url = form.data('saveUrl');
  const method = form.data('saveMethod');
  const lodash = window._;

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

    console.log(status, data);
    if(status === 200){
      setTimeout(() => {
        window.history.back();
      }, 2000);

      return alert('data saved succesfully');
    }

    if(status === 422){
      let error = `
      ${data.message}\r\n
      `;

      const errors = data.errors;
      if(lodash.isObject(errors)){
        lodash.each(errors, (value, key) => {
          error += `${key}  ---  ${value}\r\n`
        });
      }

      return alert(error);
    }

    alert(data.message || 'An error occurred');
  }catch(e){
    alert('a server error occurred');
  }
})


