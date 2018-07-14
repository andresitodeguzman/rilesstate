/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Session
 */

class Session {

    getApiUrl(){
        return "/api/v1/Session/";
    }

    setUrl(frag){
        return this.getApiUrl() + frag + ".php";
    }

    isValid(session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("isValid");
            var formData = new FormData();
            formData.append("this_session_id",session_id);
            fetch(url,{
                method:'POST',
                body:formData
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            })
        });
    }

    forceExpire(session_id,this_session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("forceExpire");
            var formData = new FormData();
            formData.append("session_id",session_id);
            formData.append("this_session_id",this_session_id);
            fetch(url,{
                method:'POST',
                body:formData
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            })
        });
    }


    get(session_id,this_session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append("session_id",session_id);
            formData.append("this_session_id",this_session_id);
            fetch(url,{
                method:'POST',
                body:formData
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            })
        });
    }

    getByCustomerId(session_id,customer_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getByCustomerId");
            var formData = new FormData();
            formData.append("session_id",session_id);
            formData.append("customer_id",customer_id);
            fetch(url,{
                method:'POST',
                body:formData
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            })
        });
    }

    getByAdminId(session_id,admin_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getByAdminId");
            var formData = new FormData();
            formData.append("session_id",session_id);
            formData.append("admin_id",admin_id);
            fetch(url,{
                method:'POST',
                body:formData
            }).then(res=>{
                resolve(res.json());
            }).catch(err=>{
                reject(err);
            })
        });
    }

}