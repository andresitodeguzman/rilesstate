/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Announcement
 */

var SESSION_ID = "session_id";
var ANNOUNCEMENT_ID = "announcement_id";
var ANNOUNCEMENT_CAPTION = "announcement_caption";
var ANNOUNCEMENT_DATE = "announcement_date"; 

class Announcement {
    getApiUrl(){
        return "/api/v1/Announcement/";
    }

    setUrl(frag){
        return this.getApiUrl() + frag + ".php";
    }

    getAll(SESSION_ID){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getAll");
            var formData = new FormData();
            formData.append(SESSION_ID,this.SESSION_ID);
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

    get(SESSION_ID,ANNOUNCEMENT_ID){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append(SESSION_ID,this.SESSION_ID);
            formData.append(ANNOUNCEMENT_ID,this.ANNOUNCEMENT_ID);
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

    delete(SESSION_ID,ANNOUNCEMENT_ID){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append(SESSION_ID,this.SESSION_ID);
            formData.append(ANNOUNCEMENT_ID,this.ANNOUNCEMENT_ID);
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
            formData.append(SESSION_ID,array.session_id);
            formData.append(ANNOUNCEMENT_CAPTION,array.announcement_caption);
            formData.append(ANNOUNCEMENT_DATE,new Date());
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

    update(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("update");
            var formData = new FormData();
            formData.append(SESSION_ID,array.session_id);
            formData.append(ANNOUNCEMENT_ID,array.announcement_id);
            formData.append(ANNOUNCEMENT_CAPTION,array.announcement_caption);
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