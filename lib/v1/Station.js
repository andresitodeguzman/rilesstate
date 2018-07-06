/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Station
 */

class Station {

    getApiUrl(){
        return "/api/v1/Station/";
    }

    setUrl(frag){
        return this.getApiUrl() + frag + ".php";
    }

    getAll(session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getAll");
            var formData = new FormData();
            formData.append('session_id',session_id);
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

    get(session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('station_id',station_id);
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
}