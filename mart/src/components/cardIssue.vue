<template>
<div>
  <el-table
    :data="cardIssueInfo.data"
    stripe
    style="width: 100%">
    <el-table-column
      prop="发行编码"
      align="center"
      width="150"
      label="发行编码">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.id}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="卡券类型"
      align="center"
      label="卡券类型">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.type}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="礼券名称"
      align="center"
      width="130"
      label="礼券名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.card_name}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="商品名称条形码"
      align="center"
      label="商品名称/条码"
       width="160">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.good_name}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="发行数量"
      align="center"
      label="发行数量">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.publish_number}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="激活状态"
      align="center"
      label="激活状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.status}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="有效期至"
      align="center"
      width="140"
      label="有效期至">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.can_use_data}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="核销数量"
      align="center"
      label="核销数量">
  <template slot-scope="scope">
    <span style="color:#ff0000">{{scope.row.price}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="客户名称"
      align="center"
      label="客户名称"
      width="180">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.client_name}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="通讯信息"
      align="center"
      label="通讯信息"
      width="160">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.card_name}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="销售单价"
      align="center"
      label="销售单价">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.price}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="销售折扣"
      align="center"
      label="销售折扣">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.discount}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="累计金额"
      align="center"
      width="100"
      label="累计金额">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.all_pay}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="发行人"
      align="center"
      label="发行人">
      <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.publish_man}}</span>
  </template>
    </el-table-column>
    <el-table-column
    align="center"
      label="操作">
      <template slot-scope="scope">
<el-dropdown trigger="click" placement="bottom" type="split-button" @command="handleCommand" >
  <span class="el-dropdown-link" @click="setFormData(scope.row)">
    <i class="el-icon-arrow-down el-icon--right"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item command="1" >修改编辑</el-dropdown-item>
    <el-dropdown-item command="2">冻结卡券</el-dropdown-item>
    <el-dropdown-item command="3">撤销卡券</el-dropdown-item>
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
      :total="cardIssueInfo.count">
    </el-pagination>
      <el-dialog title="卡券信息" :visible.sync="dialogFormVisible" center>
        <el-form :model="cardForm" class="form">
          <el-form-item label="客户名称" label-width="120px">
            <el-col :span="24">
            <el-input v-model="cardForm.client_name" auto-complete="off"></el-input>
            </el-col>
          </el-form-item>
          <el-form-item label="联系电话" label-width="120px">
            <el-col :span="10">
            <el-input v-model="cardForm.link_phone" auto-complete="off"></el-input>
            </el-col>
            <el-col :span="2" :offset="1">
              联系人
            </el-col>
            <el-col :span="10">
              <el-input v-model="cardForm.link_man" auto-complete="off"></el-input>
            </el-col>
          </el-form-item>
          <el-form-item label="礼券名称" label-width="120px">
            <el-input v-model="cardForm.card_name" auto-complete="off"></el-input>
          </el-form-item>
          <el-form-item label="礼券类型" label-width="120px">
            <el-input v-model="cardForm.type" auto-complete="off"></el-input>
          </el-form-item>
          <el-form-item label="发行数量" label-width="120px">
            <el-col :span="10">
            <el-input v-model="cardForm.publish_number" auto-complete="off"> <template slot="append">份</template></el-input>
            </el-col>
            <el-col :span="2" :offset="1">
              销售单价
            </el-col>
            <el-col :span="10">
              <el-input v-model="cardForm.price" auto-complete="off"></el-input>
            </el-col>
          </el-form-item>
          <el-form-item label="折扣率" label-width="120px">
            <el-col :span="10">
            <el-input v-model="cardForm.discount" auto-complete="off"> <template slot="append">%</template></el-input>
            </el-col>
          </el-form-item>
          <el-form-item label="有效周期" label-width="120px">
            <el-col :span="10">
            <el-input v-model="cardForm.can_use_data" auto-complete="off"> <template slot="append">天</template></el-input>
            </el-col>
            <el-col :span="2" :offset="1">
              有效期至
            </el-col>
            <el-col :span="10">
              <el-date-picker
                v-model="cardForm.can_use_data"
                format="yyyy年MM月dd日"
                value-format="yyyy年MM月dd日"
                type="date"
                placeholder="选择日期">
              </el-date-picker>
            </el-col>
          </el-form-item>
          <el-form-item label="计时规则" label-width="120px">
            <el-radio v-model="cardForm.计时规则" label="发行日起记"></el-radio>
            <el-radio v-model="cardForm.计时规则" label="激活日起记"></el-radio>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button type="success"  @click="editCardIssue()">保存</el-button>
        </div>
      </el-dialog>
      </div>
</template>

<script>

import qs from 'qs'

  export default {
    data() {
      return {
      dialogFormVisible:false,
      contextPath:"code/public/index.php/index",
      cardForm:{},
        param:{
          pageIndex:1,
          pageSize:20,
          condition:{},
        },
        cardIssueInfo:{
          count:0,
          data:[
          {
            id:"",
            type: "",
            card_name: "",
            good_name: "",
            public_number: 1000,
            status: "",
            can_use_data: "",
            client_data: "",
            link_man: "",
            link_phone: "",
            warming_data:8,
            price: 9999.0,
            discount: 10.86,
            pay: 96.24,
            all_pay: 9999999.0,
            publish_man: "",
            operate_time: ""}
          ],
        },
      }
    },
      created:function(){
          this.getCardIssueInfo();
      },
      methods:{
      getCardIssueInfo:function(pages){
        var self=this;
        if(!pages){
          this.$axios.post("/api/code/public/index.php/index/Card_issue/query",qs.stringify(self.param)).then(function(res){
            if(res.data.status==1){
              self.cardIssueInfo=res.data;
            }else{
          self.$message({
                    showClose: true,
                    message: res.data.message,
                    type: 'error'
                  });
            }
          });
        }else{
          this.$axios.post("/api/code/public/index.php/index/Card_issue/query",qs.stringify({pages:pages,pageSize:20})).then(function(res){
            if(res.data.status==1){
              self.cardIssueInfo=res.data;
            }else{
          self.$message({
                    showClose: true,
                    message: res.data.message,
                    type: 'error'
                  });
            }
          });
        }
      },
      editCardIssue:function(){
        var self=this;
        self.cardForm.pay=(100-parseFloat(self.cardForm.discount))*self.cardForm.price/100;
        self.cardForm.all_pay=self.cardForm.publish_number*self.cardForm.number;
        console.log(self.cardForm);
        this.$axios.post("/api/code/public/index.php/index/Card_issue/update",qs.stringify(self.cardForm)).then(function(res){
          if(res.data.status==1){
            self.$message({
               showClose: true,
                message: '操作成功',
                type: 'success'
              });
            self.formVisible=false
            self.getCardIssueInfo();
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
        var self=this;
        if(command=='1'){
          this.dialogFormVisible=true
        }
        if(command=='2'){
        self.cardForm.激活状态="已冻结"
        this.$axios.post("/api/code/public/index.php/index/Card_issue/update",qs.stringify(self.cardForm)).then(function(res){
          if(res.data.status==1){
            self.$message({
               showClose: true,
                message: '操作成功',
                type: 'success'
              });
            self.formVisible=false
            self.getCardIssueInfo();
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
        var param={
        _id:self.cardForm._id
        }
        this.$axios.post(this.contextPath + "/api/cardPublish/delete",qs.stringify(param)).then(function(res){
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
      // nowindex(){
      //   console.log("this.param.pageindex:",this.param.pageindex);
      // },
      handleSizeChange(val) {
        var self=this;
        self.getCardIssueInfo();
        console.log(`每页 ${val} 条`);
      },
      handleCurrentChange(val) {
        var self=this;
        let pages = val;
        self.getCardIssueInfo(pages);
        console.log(`当前页: ${val}`);
      },

    },
  }
</script>
