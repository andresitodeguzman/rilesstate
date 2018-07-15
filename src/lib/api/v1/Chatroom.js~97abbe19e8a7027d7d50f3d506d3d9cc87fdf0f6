/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Chatroom
 */

 class Chatroom {

    getApiUrl(){
        return "/api/v1/Chatroom/";
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

    get(session_id,chatroom_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('chatroom_id',chatroom_id);
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

    getByCode(session_id,code){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getByCode");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('code',code);
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

    delete(session_id,chatroom_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('chatroom_id',chatroom_id);
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
            formData.append('session_id',array.session_id);
            formData.append('name',array.name);
            formData.append('category',array.category);
            formData.append('tags',array.tags);
            formData.append('code',array.code);
            formData.append('description',array.description);
            formData.append('image_url',array.image_url);
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
            formData.append('session_id',array.session_id);
            formData.append('chatroom_id',array.chatroom_id);
            formData.append('name',array.name);
            formData.append('category',array.category);
            formData.append('tags',array.tags);
            formData.append('code',array.code);
            formData.append('description',array.description);
            formData.append('image_url',array.image_url);
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