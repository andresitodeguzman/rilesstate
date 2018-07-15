/**
 * RailTime
 * 2018
 * 
 * API JS
 * Class
 * 
 * Survey
 */
 
var SESSION_ID = "session_id";
var SURVEY_ID = "survey_id";
var SURVEY_QUESTION = "survey_question";
var SURVEY_CHOICES = "survey_choices";
var SURVEY_ADDED_BY = "survey_added_by"; 
var SURVEY_DATE_ADDED = "survey_date_added"; 

class Forum {
    getApiUrl(){
        return "/api/v1/Survey/";
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

    get(session_id,survey_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("get");
            var formData = new FormData();
            formData.append(SESSION_ID,this.session_id);
            formData.append(SURVEY_ID,this.survey_id);
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

    delete(session_id,survey_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
            var formData = new FormData();
            formData.append(SESSION_ID,this.session_id);
            formData.append(SURVEY_ID,this.survey_id);
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
            formData.append(SURVEY_QUESTION,array.survey_question);
            formData.append(SURVEY_CHOICES,array.survey_choices);
            formData.append(SURVEY_ADDED_BY,array.survey_added_by);
            formData.append(SURVEY_DATE_ADDED,new Date());
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
            formData.append(SURVEY_ID,array.survey_id);
            formData.append(SURVEY_QUESTION,array.survey_question);
            formData.append(SURVEY_CHOICES,array.survey_choices);
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