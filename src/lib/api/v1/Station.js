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

    get(session_id,station_id){
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

    delete(session_id,station_id){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("delete");
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

    add(array){
        return new Promise((resolve,reject)=>{
            var url = this.setUrl("add");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('name',array.name);
            formData.append('shortname',array.shortname);
            formData.append('address',array.address);
            formData.append('city',array.city);
            formData.append('latitude',array.latitude);
            formData.append('longitude',array.longitude);
            formData.append('line',array.line);
            formData.append('is_terminal',array.is_terminal);
            formData.append('southbound_next',array.southbound_next);
            formData.append('northbound_next',array.northbound_next);
            formData.append('position',array.position);
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
            var url = this.setUrl("add");
            var formData = new FormData();
            formData.append('session_id',array.session_id);
            formData.append('station_id',array.station_id);
            formData.append('name',array.name);
            formData.append('shortname',array.shortname);
            formData.append('address',array.address);
            formData.append('city',array.city);
            formData.append('latitude',array.latitude);
            formData.append('longitude',array.longitude);
            formData.append('line',array.line);
            formData.append('is_terminal',array.is_terminal);
            formData.append('southbound_next',array.southbound_next);
            formData.append('northbound_next',array.northbound_next);
            formData.append('position',array.position);
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