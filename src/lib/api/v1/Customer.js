/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Customer
 */


class Customer {

    getApiUrl(){
        return "api/v1/Customer/";
    }

    setUrl(frag){
        return this.getApiUrl() + frag + ".php";
    }

    verifyLogin(username,password){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("verifyLogin");
            var formData = new FormData();
            formData.append('username',username);
            formData.append('password',password);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });    
        });
    }

    add(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("add");
            var formData = new FormData();
            formData.append('first_name',array.first_name);
            formData.append('middle_name',array.middle_name);
            formData.append('last_name',array.last_name);
            formData.append('address',array.address);
            formData.append('status',array.status);
            formData.append('email',array.email);
            formData.append('mobile_number',array.mobile_number);
            formData.append('username',array.username);
            formData.append('password',array.password);
            formData.append('gender',array.gender);
            formData.append('dev_share_stats',array.dev_share_stats);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                
                resolve(JSON.parse(res.text()));
            }).catch(err=>{
                reject(err);
            });
        });
    }

    updateBasic(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("updateBasic");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('customer_id',array.customer_id);
            formData.append('first_name',array.first_name);
            formData.append('middle_name',array.middle_name);
            formData.append('last_name',array.last_name);
            formData.append('address',array.address);
            formData.append('status',array.status);
            formData.append('email',array.email);
            formData.append('mobile_number',array.mobile_number);
            formData.append('gender',array.gender);
            formData.append('dev_share_stats',array.gender);
            formData.append('dev_share_stats',array.dev_share_stats);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    updateUsername(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("updateUsername");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('customer_id',array.customer_id);
            formData.append('username',array.username);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    updatePassword(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("updatePassword");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('customer_id',array.customer_id);
            formData.append('password',array.password);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    get(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('customer_id',array.customer_id);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    getByUsername(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getByUsername");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('username',array.username);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    delete(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('customer_id',array.customer_id);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    usernameExists(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("usernameExists");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('username',array.username);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    searchBy(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("searchBy");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('category',array.category);
            formData.append('query',array.query);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        });
    }

    getAll(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getAll");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            fetch(url,{
                method:'POST',
                body: formData,
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            });
        })
    }

}
