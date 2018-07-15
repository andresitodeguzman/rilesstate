/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Forum
 */
 
var SESSION_ID = "session_id";
var FORUM_ID = "forum_id";
var FORUM_STATION_ID = "forum_station_id";
var FORUM_COMMENT = "forum_comment";
var FORUM_COMMENT_BY = "forum_comment_by"; 
var FORUM_DATE_ADDED = "forum_date_added"; 

class Forum {
    getApiUrl(){
        return "/api/v1/Forum/";
    }

    setUrl(frag){
        return this.getApiUrl() + frag + ".php";
    }

    getAll(session_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getAll");
            var formData = new FormData();
            formData.append(SESSION_ID,this.session_id);
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

    get(session_id,forum_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append(SESSION_ID,this.session_id);
            formData.append(FORUM_ID,this.forum_id);
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

    delete(session_id,forum_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append(SESSION_ID,this.session_id);
            formData.append(FORUM_ID,this.forum_id);
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
            formData.append(FORUM_STATION_ID,array.forum_station_id);
            formData.append(FORUM_COMMENT,array.forum_comment);
            formData.append(FORUM_COMMENT_BY,array.forum_comment_by);
            formData.append(FORUM_DATE_ADDED,new Date());
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
            formData.append(FORUM_ID,array.forum_id);
            formData.append(FORUM_COMMENT,array.forum_comment);
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