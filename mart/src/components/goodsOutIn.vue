<template>
<div>
  <el-table
    :data="goodsOutIn.data"
    stripe
    style="width: 100%">
    <el-table-column
      prop="商品品类"
      align="center"
      label="商品品类">
    </el-table-column>
    <el-table-column
      prop="商品条形码"
      align="center"
      width="150"
      label="商品条形码">
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
      prop="商品属性"
      align="center"
      label="商品属性">
    </el-table-column>
    <el-table-column
      prop="销售单位"
      align="center"
      label="销售单位">
    </el-table-column>
    <el-table-column
      prop="当前库存"
      align="center"
      label="当前库存">
  <template slot-scope="scope">
    <span style="color:#ff0000">{{scope.row.当前库存}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="type2"
      align="订单编码"
      width="150"
      label="订单编码">
    </el-table-column>
    <el-table-column
      prop="仓位名称"
      align="center"
      width="130"
      label="仓位名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.仓位名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="订货数量"
      align="center"
      label="订货数量">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.订货数量}}</span>
  </template>
    </el-table-column>

    <el-table-column
      prop="name"
      align="供应商"
      width="110"
      label="供应商">
    </el-table-column>
    <el-table-column
      prop="执行采购"
      align="center"
      label="执行采购">
    </el-table-column>
    <el-table-column
      prop="处理状态"
      align="center"
      label="处理状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.处理状态}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="实收数量"
      align="center"
      label="实收数量">
  <template slot-scope="scope">
    <span style="color:#ff0000">{{scope.row.处理状态}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="入库执行"
      align="center"
      label="入库执行">
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
    <el-dropdown-item command="1">商品入库</el-dropdown-item>
    <el-dropdown-item command="2">修改编辑</el-dropdown-item>
    <el-dropdown-item command="3">打印表单</el-dropdown-item>
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
        :total="goodsOutIn.count">
      </el-pagination>

<el-dialog title="订单编辑" :visible.sync="dialogFormVisible" center>
  <el-col :span="24">
  <el-form :model="form" class="form">
    <el-col :span="12" :offset="4">
    <el-form-item label="订单编码" label-width="120px">
      20180302059100001
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="4">
    <el-form-item label="商品名称" label-width="120px">
      阳澄湖大闸蟹
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="4">
    <el-form-item label="商品条码" label-width="120px">
      20180302059100001
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="4">
    <el-form-item label="规格型号" label-width="120px">
      200g x 5
    </el-form-item>
    </el-col>
    <el-col :span="8" :offset="4">
    <el-form-item label="商品品类" label-width="120px">
      时令生鲜
    </el-form-item>
    </el-col>
    <el-col :span="5" >
    <el-form-item label="销售单位" label-width="120px">
      个
    </el-form-item>
    </el-col>
    <el-col :span="8" :offset="4">
    <el-form-item label="出厂包装" label-width="120px">
      塑料筐
    </el-form-item>
    </el-col>
    <el-col :span="6" >
    <el-form-item label="商品属性" label-width="120px">
      正价商品
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="4">
    <el-form-item label="供应商" label-width="120px">
      苏州苏状元商行
    </el-form-item>
    </el-col>
    <el-col :span="8" :offset="4">
    <el-form-item label="订单数量" label-width="120px">
      <span style="color:blue">9999 件</span>
    </el-form-item>
    </el-col>
    <el-col :span="6" >
    <el-form-item label="实收数量" label-width="120px">
      <el-input v-model="num" auto-complete="off"></el-input>
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
      contextPath:"",
        dialogFormVisible:false,
        num:"",
        goodsOutIn:{
          count:0,
          data:[],
        },
        param:{
          pageIndex:1,
          pageSize:20,
          condition:{},
        },
        tableData: [{
          code: '20180221059100001',
          type: '提货券',
          type2: '运通星 中秋礼券',
          name:"阳澄湖大闸蟹 200g x 5 01803061001",
        }]
      }
    },
      created:function(){
          this.getGoodsOutInInfo();
      },
      methods:{
      getGoodsOutInInfo:function(){
        var self=this;
        this.$axios.post(this.contextPath + "/api/commodityInOut/query",JSON.stringify(self.param)).then(function(res){
          if(res.data.status==1){
            self.goodsOutIn=res.data
          }else{
        self.$message({
                  showClose: true,
                  message: res.data.message,
                  type: 'error'
                });
          }
        });
      },
      handleCommand(command) {
        if(command=='1'){
          this.dialogFormVisible=true
        }
        if(command=='2'){
          this.dialogFormVisible=true
        }
        if(command=='3'){
        self.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
      }
      }
  }
</script>
