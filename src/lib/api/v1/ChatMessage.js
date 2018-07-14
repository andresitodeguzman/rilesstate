/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * ChatMessage
 */

class ChatMessage {

    getApiUrl(){
        return "/api/v1/ChatMessage/";
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

    get(session_id,message_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('chatroom_id',message_id);
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

    getByChatroomId(session_id,chatroom_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("getByChatroomId");
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

    deleteByChatroomId(session_id,chatroom_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("deleteByChatroomId");
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

    delete(session_id,message_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append('session_id',session_id);
            formData.append('message_id',message_id);
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
            formData.append('chatroom_id',array.chatroom_id);
            formData.append('customer_id',array.customer_id);
            formData.append('body',array.body);
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