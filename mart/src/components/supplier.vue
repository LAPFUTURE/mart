<template>
<div>
  <el-table
    :data="supplierInfo.data"
    stripe
    style="width: 100%">
    <el-table-column
      prop="供应商编码"
      align="center"
      width="150"
      label="供应商编码">

    </el-table-column>
    <el-table-column
      prop="主体名称"
      align="center"
      width="110"
      label="主体名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.主体名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="供货品类"
      align="center"
      label="供货品类">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.供货品类}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="联系地址"
      align="center"
      label="联系地址"
      width="210">
    </el-table-column>
    <el-table-column
      prop="通讯信息"
      align="center"
      width="110"
      label="通讯信息">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.通讯信息}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="电子邮箱"
      align="center"
      width="150"
      label="电子邮箱">
    </el-table-column>
    <el-table-column
      prop="收款账户信息"
      align="center"
      width="220"
      label="收款账户信息">
    </el-table-column>
    <el-table-column
      prop="法人信息"
      align="center"
      width="150"
      label="法人信息">
    </el-table-column>
    <el-table-column
      prop="合同有效期"
      align="center"
      width="90"
      label="合同有效期">
    </el-table-column>
    <el-table-column
      prop="附件图片"
      align="center"
      label="附件图片">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.附件图片}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="执行人"
      align="center"
      label="执行人">
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
    <el-dropdown-item command="1">修改编辑</el-dropdown-item>
    <el-dropdown-item command="2">账户冻结</el-dropdown-item>
    <el-dropdown-item command="3">解除合作</el-dropdown-item>
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
      :total="supplierInfo.count">
    </el-pagination>
 <el-dialog title="供应商编辑" :visible.sync="supplierFormVisible" center>
      <el-form :model="cardForm" class="form">
        <el-form-item label="主体名称" label-width="120px">
          <el-col :span="24">
          <el-input v-model="cardForm.主体名称" auto-complete="off"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="联系地址" label-width="120px">
          <el-col :span="10">
          <el-select v-model="address.省" placeholder="省" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="12">
          <el-select v-model="address.市" placeholder="市" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option >
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="10">
          <el-select v-model="address.区" placeholder="区/县" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="12">
          <el-select v-model="address.街道" placeholder="街道" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="24">
          <el-input v-model="address.详细地址" auto-complete="off"  placeholder="详细地址   道路名称/门牌号/小区名称 楼号 房间号"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="通讯信息" label-width="120px">
          <el-col :span="10">
            <el-input v-model="cardForm.负责人" auto-complete="off"  placeholder="负责人"></el-input>
          </el-col>
          <el-col :span="12">
            <el-input v-model="cardForm.联系电话" auto-complete="off"  placeholder="联系电话"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="cardForm.电子邮箱" auto-complete="off"  placeholder="电子邮箱"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="账号信息" label-width="120px">
          <el-col :span="24">
          <el-input v-model="cardForm.收款账户" auto-complete="off"  placeholder="收款账户"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="cardForm.开户行" auto-complete="off"  placeholder="开户行"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="cardForm.收款人" auto-complete="off"  placeholder="收款人"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="法人信息" label-width="120px">
          <el-col :span="12">
          <el-input v-model="cardForm.法人姓名" auto-complete="off"  placeholder="法人姓名"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="cardForm.身份证号" auto-complete="off"  placeholder="身份证号"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="合同信息" label-width="120px">
          <el-col :span="10">
            <el-date-picker
              v-model="cardForm.签署时间"
              format="yyyy年MM月dd日"
              value-format="yyyy年MM月dd日"
              type="date"
              placeholder="签署时间">
            </el-date-picker>
          </el-col>
          <el-col :span="12">
          <el-select v-model="cardForm.有效周期" placeholder="有效周期">
            <el-option label="1年" value="1年"></el-option>
            <el-option label="2年" value="2年"></el-option>
            <el-option label="3年" value="3年"></el-option>
          </el-select>
          </el-col>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button type="success"  @click="updateSupplierInfo">保存</el-button>
      </div>
    </el-dialog>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        supplierFormVisible:false,
      contextPath:"",
        cardForm:{},
        address:{},
        param:{
          pageIndex:1,
          pageSize:20,
          condition:{},
        },
        supplierInfo:{
          count:0,
          data:[
          {
          卡券编码: "51650001",
          }
          ],
        },
      }
    },
      created:function(){
          this.getSupplierInfo();
      },
      methods:{
      getSupplierInfo:function(){
        var self=this;
        this.$axios.post(this.contextPath + "/api/supplier/query",JSON.stringify(self.param)).then(function(res){
          if(res.data.status==1){
            self.supplierInfo=res.data
          }else{
        self.$message({
                  showClose: true,
                  message: res.data.message,
                  type: 'error'
                });
          }
        });
      },
      updateSupplierInfo:function(){
        var self=this;
        self.cardForm.合同有效期=parseInt(self.cardForm.签署时间.substring(0,4))+parseInt(self.cardForm.有效周期)+self.cardForm.签署时间.substring(4)
        self.cardForm.联系地址=self.address.省+self.address.市+self.address.区+self.address.街道+self.address.详细地址
        this.$axios.post(this.contextPath + "/api/supplier/update",JSON.stringify(self.cardForm)).then(function(res){
          if(res.data.status==1){
        self.$message({
                  showClose: true,
                  message: '操作成功',
                  type: 'success'
                });
            self.supplierFormVisible=false,
            self.getSupplierInfo()

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
      handleCommand(command) {
        if(command=='1'){
          this.supplierFormVisible=true
        }
        if(command=='2'){
        self.cardForm.状态="冻结"
        this.$axios.post(this.contextPath + "/api/supplier/update",JSON.stringify(self.cardForm)).then(function(res){
          if(res.data.status==1){
        self.$message({
                  showClose: true,
                  message: '操作成功',
                  type: 'success'
                });
            self.getSupplierInfo()

          }else{
        self.$message({
                  showClose: true,
                  message: res.data.message,
                  type: 'error'
                });
          }
        });
        }
        if(command=='3'){
        this.$axios.post(this.contextPath + "/api/supplier/delete",JSON.stringify(self.cardForm.供应商编码)).then(function(res){
          if(res.data.status==1){
        self.$message({
                  showClose: true,
                  message: '操作成功',
                  type: 'success'
                });
            self.getSupplierInfo()
          }else{
        self.$message({
                  showClose: true,
                  message: res.data.message,
                  type: 'error'
                });
          }
        });
        }
      }
      }
  }
</script>
