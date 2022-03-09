<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>




<div class="container-sm" id="dynamicApp" style="padding:25px;">
<figure class="text-center">
  <blockquote class="blockquote">
    <p>นี่คือแอพพลิชั่นสำหรับการประเมิณคุณภาพดิน</p>
  </blockquote>
  <figcaption class="blockquote-footer">
    กรุณากรอกค่าคุณภาพดิน <cite title="Source Title">ด้านล่างนี้</cite>
  </figcaption>
</figure>
<h3 class="d-flex justify-content-center card-header" style="margin-head:40px;">ค่าคุณภาพดิน</h3>
  <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">ค่าความชื้นในดิน</span>
      <input v-model="sm" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" @keyup="fetchSm(sm,ec,ph)">
  </div>
  <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">ค่าความเค็มในดิน</span>
      <input v-model="ec" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" @keyup="fetchEc(sm,ec,ph)">
  </div>
  <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">ค่าความเป็นกรดเป็นด่าง</span>
      <input v-model="ph" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" @keyup="fetchPh(sm,ec,ph)">
  </div>
<div class="d-flex justify-content-center" @click="cal(sm,ec,ph)" style="margin:20px;"><a class="btn btn-outline-warning" href="https://www.ldd.go.th/Web_Soil/Page_02.htm" role="button">ดูวิธีการปรับปรุงดิน</a></div>

    <h3 class="d-flex justify-content-center card-header" style="margin-bottom:20px;">พืชที่สามารถปลูกได้มีดังนี้</h3>
    <div class="row g-2">
        <div v-for="data in selector" class="col"><p type="button" class="btn btn-success" style="width:190px;">{{ data.name }}</p></div>
    </div>

</div>

<script>

var application = new Vue({
 el:'#dynamicApp',
 data:{
  sm:'',
  ec:'',
  ph:'',
  selector:[],
  Data:[
        { name: "กระทกรก",      smmax: 55, smmin: 42, ecmax: 2.4,ecmin: 1.6,phmax: 6.5,phmin: 6},
        { name: "กระเทียม",      smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.4,phmax: 6.5,phmin: 6},
        { name: "กระเทียมต้น",    smmax: 55, smmin: 42, ecmax: 3,ecmin: 2,phmax: 7,phmin: 6.5},
        { name: "กระเพรา",       smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.8,phmax: 6.5,phmin: 5.5},
        { name: "กระหล่ำปลี",     smmax: 55, smmin: 42, ecmax: 3,ecmin: 2.5,phmax: 7,phmin: 6},
        { name: "กล้วย",         smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.8,phmax: 6.5,phmin: 6},
        { name: "กะหล่ำดอก",     smmax: 55, smmin: 42, ecmax: 3,ecmin: 2.5,phmax: 6.5,phmin: 6},
        { name: "กะหล่ำปม",      smmax: 55, smmin: 42, ecmax: 2.4,ecmin: 1.8,phmax: 6.5,phmin: 6},
        { name: "ข้าว",          smmax: 55, smmin: 42, ecmax: 4,ecmin: 2,phmax: 6,phmin: 5},
        { name: "ข้าวโพดเลี้ยงสัตว์", smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 1.6,phmax: 6.5,phmin: 6},
        { name: "ข้าวโพดหวาน",   smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 1.6,phmax: 6.5,phmin: 6},
        { name: "ขึ้นฉ่าย",        smmax: 55, smmin: 42, ecmax: 3,ecmin: 2.5,phmax: 6.5,phmin: 6},
        { name: "คะน้า",         smmax: 55, smmin: 42, ecmax: 3,ecmin: 3.5,phmax: 6.4,phmin: 6},
        { name: "แคคตัส",        smmax: 55, smmin: 42, ecmax: 1.8,ecmin: 1.2,phmax: 6.5,phmin: 6},
        { name: "แครอท",        smmax: 55, smmin: 42, ecmax: 2.2,ecmin: 1.8,phmax: 6.3,phmin: 5.8},
        { name: "ดาวเรือง",      smmax: 55, smmin: 42, ecmax: 2.4,ecmin: 1.6,phmax: 6.5,phmin: 5.5},
        { name: "แตงกวา",       smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 1,phmax: 6,phmin: 5.5},
        { name: "แตงโม",        smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 1.7,phmax: 6.2,phmin: 5.8},
        { name: "ถั่ว",           smmax: 55, smmin: 42, ecmax: 4,ecmin: 2,phmax: 6.2,phmin: 5.5},
        { name: "บล็อกโคลี",      smmax: 55, smmin: 42, ecmax: 2.4,ecmin: 1.8,phmax: 6.5,phmin: 6},
        { name: "ปาล์มน้ำมัน",      smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.6,phmax: 7.5,phmin: 6},
        { name: "ผักกาดหอม",      smmax: 55, smmin: 42, ecmax: 1.2,ecmin: 0.8,phmax: 6.5,phmin: 6},
        { name: "ผักกาดหอมห่อ",   smmax: 55, smmin: 42, ecmax: 1.6,ecmin: 0.9,phmax: 6.5,phmin: 6},
        { name: "ผักกาดหัว",      smmax: 55, smmin: 42, ecmax: 5,ecmin: 1.8,phmax: 7.2,phmin: 7},
        { name: "ผักกาดฮ่อง",     smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.5,phmax: 7.5,phmin: 6.5},
        { name: "ผักโขม",        smmax: 55, smmin: 42, ecmax: 1.8,ecmin: 1.4,phmax: 7,phmin: 5},
        { name: "พริก",          smmax: 55, smmin: 42, ecmax: 2.2,ecmin: 1.8,phmax: 6.5,phmin: 6},
        { name: "ฟักทอง",        smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 1.7,phmax: 6.5,phmin: 5.5},
        { name: "เฟิร์น",         smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.6,phmax: 6.5,phmin: 6},
        { name: "มะเขือ",        smmax: 55, smmin: 42, ecmax: 3.5,ecmin: 2.5,phmax: 6.2,phmin: 5.8},
        { name: "มะเขือเทศ",      smmax: 55, smmin: 42, ecmax: 5,ecmin: 2,phmax: 6.5,phmin: 5.5},
        { name: "มะนาว",        smmax: 55, smmin: 42, ecmax: 2.2,ecmin: 1.8,phmax: 6.5,phmin: 5.5},
        { name: "มะม่วง",        smmax: 55, smmin: 42, ecmax: 1.8,ecmin: 1.2,phmax: 6.5,phmin: 6},
        { name: "มะละกอ",       smmax: 55, smmin: 42, ecmax: 2.4,ecmin: 1.6,phmax: 6.5,phmin: 6},
        { name: "มันฝรั่ง",        smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 2,phmax: 6.5,phmin: 5},
        { name: "มันสำปะหลัง",    smmax: 55, smmin: 42, ecmax: 2.5,ecmin: 2,phmax: 6,phmin: 5},
        { name: "ยางพารา",       smmax: 55, smmin: 42, ecmax: 2,ecmin: 1.8,phmax: 6,phmin: 5},
        { name: "ส้ม",           smmax: 55, smmin: 42, ecmax: 2.2,ecmin: 1.8,phmax: 6,phmin: 5.5},
        { name: "หน่อไม้ฝรั่ง",     smmax: 55, smmin: 42, ecmax: 1.8,ecmin: 1.4,phmax: 6.8,phmin: 6},
        { name: "อ้อย",          smmax: 55, smmin: 42, ecmax: 2.5,enmin: 2,phmax: 7.5,phmin: 6},
        { name: "หอม",          smmax: 55, smmin: 42, ecmax: 1.8,enmin: 1.4,phmax: 7,phmin: 6},
    ]
 },

 methods:{
      cal:function(sm,ec,ph) {
        if(sm,ec,ph == ""){
            (alert("กรุณากรอกข้อมูลให้ครบ"))
        }else{
            this.selector = this.Data.filter(function(names){
                return  names.smmin <= sm && 
                        names.smmax >= sm &&
                        names.ecmin <= ec &&
                        names.ecmax >= ec &&
                        names.phmin <= ph &&
                        names.phmax >= ph;
            });

            // console.log(this.selector);
            // console.log(this.sm);
            // console.log(this.ec);
            // console.log(this.ph);

        }
      },
    
        fetchSm:function(sm) {
                this.selector = this.Data.filter(function(names){
                return  names.smmin <= sm && names.smmax >= sm;
            });
      },
        fetchEc:function(sm,ec) {
                this.selector = this.Data.filter(function(names){
                    return names.smmin <= sm && names.smmax >= sm && names.ecmin <= ec && names.ecmax >= ec;
                });
        },
        fetchPh:function(sm,ec,ph) {
                this.selector = this.Data.filter(function(names){
                    return  names.smmin <= sm && names.smmax >= sm && names.ecmin <= ec && names.ecmax >= ec && names.phmin <= ph && names.phmax >= ph;
                });
        },

    },
    created(){
        this.cal();
    }

});



</script>
