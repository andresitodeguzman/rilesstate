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
            formData.append("session_id",session_id);
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