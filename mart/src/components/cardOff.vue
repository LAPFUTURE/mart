<template>
  <div>
  <el-table
    :data="cardOffInfo.data"
    stripe
    style="width: 100%">
    <el-table-column
      prop="卡券编码"
      align="center"
      width="150"
      label="卡券编码">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.卡券编码}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="卡券类型"
      align="center"
      label="卡券类型">
    </el-table-column>
    <el-table-column
      prop="礼券名称"
      align="center"
      width="120"
      label="礼券名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="商品名称条形码"
      align="center"
      label="商品名称/条码"
       width="160">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.商品名称条形码}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="发行数量"
      align="center"
      label="发行数量">
    </el-table-column>
    <el-table-column
      prop="发行人"
      align="center"
      label="发行人">
    </el-table-column>
    <el-table-column
      prop="核销状态"
      align="center"
      label="核销状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.核销状态}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="核销渠道"
      align="center"
      width="100"
      label="核销渠道">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.核销渠道}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="核销人"
      align="center"
      label="核销人">
    </el-table-column>
    <el-table-column
      prop="配送地址"
      align="center"
      label="配送地址"
      width="210">
    </el-table-column>
    <el-table-column
      prop="配送时段"
      align="center"
      label="配送时段">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.配送时段}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="收货人信息"
      align="center"
      width="120"
      label="收货人信息">
    </el-table-column>
    <el-table-column
      prop="配送执行"
      align="center"
      label="配送执行">
    </el-table-column>
    <el-table-column
      prop="配送单号"
      align="center"
      width="120"
      label="配送单号">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.配送单号}}</span>
  </template>
    </el-table-column>
    <el-table-column
    align="center"
      label="操作">
      <template slot-scope="scope">
<el-dropdown trigger="click" placement="bottom" @command="handleCommand">
  <span class="el-dropdown-link">
    <i class="el-icon-arrow-down el-icon--right" @click="setFormData(scope.row)"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item  command="1">商品配置</el-dropdown-item>
    <el-dropdown-item command="2">刷新</el-dropdown-item>
    <el-dropdown-item command="3">卡券导出</el-dropdown-item>
    <el-dropdown-item command="4">废弃本券</el-dropdown-item>
  </el-dropdown-menu>
</el-dropdown>
      </template>
    </el-table-column>
  </el-table>
    <el-pagination
      @size-change="handleSizeChange"
      @current-change="handleCurrentChange"
      :current-page="param.pageIndex"
      :page-sizes="[10, 20, 30, 40]"
      :page-size="param.pageSize"
      layout="total, sizes, prev, pager, next, jumper"
      :total="cardOffInfo.count">
    </el-pagination>
<el-dialog
  title="商品配置"
  :visible.sync="dialogVisible"
  :before-close="handleClose" center>
   <el-col :span="24" style="margin-bottom:10px">
   <el-col :span="6" :offset="4">
                  <el-input
                    size="small"
                    suffix-icon="el-icon-search"
                    style="border-radius:4px"
                   >
                  </el-input>
             </el-col>
             <el-col :span="8" :offset="4">
             已选商品<span style="color:blue">{{num}}</span>件
             </el-col>
    </el-col>
   <el-col :span="24" style="margin-bottom:10px">
   <el-col :span="6" :offset="4">
      <el-select v-model="selectMap" placeholder="">
       <el-option label="类型一" value="shanghai"></el-option>
       <el-option label="类型二" value="beijing"></el-option>
       </el-select>
             </el-col>
             <el-col :span="8" :offset="4">
             累计金额<span style="color:blue">188001.00</span>元
             </el-col>
    </el-col>
  <el-col :span="24" style="margin-bottom:10px">

  <el-col :span="10" :offset="2">
   <div style="border: 1px solid #E7ECF3;height:80px">
       <el-col :span="24">
        <el-col :span="16">
        <span>阳澄湖大闸蟹</span>
       </el-col>
        <el-col :span="8">
        <el-checkbox v-model="checked"></el-checkbox>
       </el-col>
       </el-col>
   </div>
</el-col>
  <el-col :span="10">
  <div style="border: 1px solid #E7ECF3;height:80px">
         <el-col :span="24">
          <el-col :span="10">
          <span>阳澄湖大闸蟹</span>
         </el-col>
          <el-col :span="8">
           <el-input-number v-model="num" @change="handleChange" :min="1" :max="10" label="描述文字"></el-input-number>
         </el-col>
         </el-col>
  </div>
</el-col>
</el-col>
  <span slot="footer" class="dialog-footer" >
    <el-button type="success" @click="dialogVisible = false">保存并提交</el-button>
  </span>
</el-dialog>
</div>
</template>

<script>
  export default {
    data() {
      return {
        dialogVisible: false,
        num:"",
      contextPath:"",
        selectMap:"",
        param:{
          pageIndex:1,
          pageSize:20,
          condition:{},
        },
        cardForm:{},
        cardOffInfo:{
          count:0,
          data:[
            {
              卡券编码: "51650001",  //必填字段，作为更新的依据
              卡券类型: "类型1",
              礼券名称: "礼券1",
              商品名称条形码: "商品名称1",
              发行人: "张三",
              客户名称: "张三",
              核销状态: "张三",
              核销渠道: "渠道1",
              核销人: "",
              配送地址 : "",
              配送时段 : "",
              配送执行 : "",
              配送单号 : "",
              执行人: "",
              操作时间 : "2018-08-04 23:23:23",
              标准能效: 1.0,
              实际能效: 2.0,
              能效差异: 3.0
            }
          ],
        },
      }
    },
      created:function(){
          this.getCardOffInfo();
      },
      methods:{
      getCardOffInfo:function(){
        var self=this;
        this.$axios.post(this.contextPath + "/api/cardVerify/query",JSON.stringify(self.param)).then(function(res){
          if(res.data.status==1){
            self.cardOffInfo=res.data
          }else{
        self.$message({
                  showClose: true,
                  message: res.data.message,
                  type: 'error'
                });
          }
        });
      },
      setFormData:function(row){
        var self=this;
        self.cardForm=row
      },
      handleChange(value) {
        console.log(value);
      },
      handleCommand(command) {
        var self=this;
        if(command=='1'){
          this.dialogVisible=true
        }
        if(command=='2'){
        self.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
        if(command=='3'){
        self.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
        if(command=='4'){
        this.$axios.post(this.contextPath + "/api/cardPublish/delete",JSON.stringify(self.cardForm.卡券编码)).then(function(res){
          if(res.data.status==1){
          self.$message({
                    showClose: true,
                    message: '操作成功',
                    type: 'success'
                  });
          }else{
          self.$message({
                    showClose: true,
                    message: res.data.message,
                    type: 'error'
                  });
          }
        })
        }
      },
      handleSizeChange(val) {
        var self=this;
        self.getCardOffInfo();
        console.log(`每页 ${val} 条`);
      },
      handleCurrentChange(val) {
        var self=this;
        self.getCardOffInfo();
        console.log(`当前页: ${val}`);
      }
      },
  }
</script>
