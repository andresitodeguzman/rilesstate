import Store from '../store/store.js'

export default {    

    signup: function(array){

        $.ajax({
            type: 'POST',
            data:array,
            url: "api/v1/Customer/add.php",
            cache: 'false',
            success: result => {
                
                this.verifylogin(array)
            
        }}).fail((err)=>{
                console.log(err)
        });

        

    },

    verifylogin: function(array){

        $.ajax({
            type: 'POST',
            data:array,
            url: "api/v1/Customer/verifyLogin.php",
            cache: 'false',
            success: result => {

                localStorage.setItem('customer', JSON.stringify(result.customer))
                
                Store.store.navigatepath('home')
                
            
        }}).fail((err)=>{
                console.log(err)
        });

    },

    
    


}


