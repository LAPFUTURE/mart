<template>
<div>
  <el-table
    :data="tableData"
    stripe
    style="width: 100%">
    <el-table-column
      prop="订单编码"
      align="center"
      width="150"
      label="订单编码">
    </el-table-column>
    <el-table-column
      prop="商品品类"
      align="center"
      label="商品品类">
    </el-table-column>
    <el-table-column
      prop="商品名称条形码"
      align="center"
      label="商品名称/条码"
       width="160">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.商品名称条形码}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="商品名称"
      align="center"
      width="100"
      label="商品名称">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.商品名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="规格型号"
      align="center"
      label="规格型号">
    </el-table-column>
    <el-table-column
      prop="当前库存"
      align="center"
      label="当前库存">
      <template slot-scope="scope">
        <span style="color:#00a200">{{scope.row.当前库存}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="警戒库存">
      <template slot-scope="scope">
        <span style="color:#ff0000">{{scope.row.警戒库存}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="销售指数">
      <template slot-scope="scope">
        <span style="display:block">1000/日</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="交货周期">
      <template slot-scope="scope">
        <span style="color:#ff0000">{{scope.row.交货周期}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="订货数量">
      <template slot-scope="scope">
        <span style="color:#00a200">{{scope.row.订货数量}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="订单金额"
      align="center"
      label="订单金额">
    </el-table-column>
    <el-table-column
      prop="供应商"
      align="center"
      width="110"
      label="供应商">
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="收货仓位">
      <template slot-scope="scope">
        <span style="color:#00a200">{{scope.row.收货仓位}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="订单状态">
      <template slot-scope="scope">
        <span style="color:#ff0000">{{scope.row.订单状态}}</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="执行采购"
      align="center"
      label="执行采购">
    </el-table-column>
    <el-table-column
    align="center"
      label="操作">
      <template slot-scope="scope">
<el-dropdown trigger="click" placement="bottom" @command="handleCommand">
  <span class="el-dropdown-link">
    <i class="el-icon-arrow-down el-icon--right"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item command="1">订货下单</el-dropdown-item>
    <el-dropdown-item command="2">修改订单</el-dropdown-item>
    <el-dropdown-item command="3">取消订单</el-dropdown-item>
  </el-dropdown-menu>
</el-dropdown>
      </template>
    </el-table-column>
  </el-table>
<el-dialog title="订单编辑" :visible.sync="dialogFormVisible" center>
  <el-col :span="24">
  <el-form :model="form" class="form">
    <el-col :span="12" :offset="6">
    <el-form-item label="商品条码" label-width="120px">
      20180302059100001
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="商品名称" label-width="120px">
      阳澄湖大闸蟹
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="规格型号" label-width="120px">
      200g x 5
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="供应商" label-width="120px">
     <template>
        <div style="border:1px solid #E7ECF3;height:80px">
       <el-col :span="24">
        <el-col :span="16">
        <span>2018年01月12日</span>
       </el-col>
        <el-col :span="8">
        <span style="color:red">9999.00</span>
       </el-col>
       </el-col>
       <el-col :span="24">
        <el-col :span="16">
        <span>苏州苏状元商行</span>
       </el-col>
        <el-col :span="8">
        <el-checkbox v-model="checked"></el-checkbox>
       </el-col>
       </el-col>
       </div>
     </template>
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送单号" label-width="120px">
      <el-input v-model="sendNum" auto-complete="off"></el-input>
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="收货仓位" label-width="120px">
      <el-select v-model="store" placeholder="">
       <el-option label="福建福州 金山一仓" value="shanghai"></el-option>
       <el-option label="北京 总仓" value="beijing"></el-option>
      </el-select>
    </el-form-item>
    </el-col>
  </el-form>
  </el-col>
  <div slot="footer" class="dialog-footer">
    <el-button type="success" @click="dialogFormVisible = false">确 定</el-button>
  </div>
</el-dialog>
</div>
</template>

<script>
  export default {
    data() {
      return {
        dialogFormVisible:false,
        store:"",
        checked:[],
        tableData: [{
          code: '20180221059100001',
          type: '提货券',
          type2: '运通星 中秋礼券',
          name:"阳澄湖大闸蟹 200g x 5 01803061001",
        }]
      }
    },
    methods:{
      handleCommand(command) {
        if(command=='1'){
          this.dialogFormVisible=true
        }
        if(command=='2'){
           this.dialogFormVisible=true

        if(command=='3'){
        this.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
        }
      }
    },
  }
</script>
