<template>
<div>
  <el-table
    :data="goodsInfo.data"
    stripe
    style="width: 100%">
    <el-table-column
      prop="商品编码"
      align="center"
      width="150"
      label="商品编码">
    </el-table-column>
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
    <span style="color:#0080ff">{{scope.row.商品名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="规格型号"
      align="center"
      label="规格型号">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.规格型号}}</span>
  </template>
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
      prop="零售价"
      align="center"
      label="零售价">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.零售价}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="成本价"
      align="center"
      label="成本价">
    </el-table-column>
    <el-table-column
      prop="利润率"
      align="center"
      label="利润率">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.利润率}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="供货价"
      align="center"
      label="供货价">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.供货价}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="供应商"
      align="center"
      width="110"
      label="供应商">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.供应商}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="出厂包装"
      align="center"
      label="出厂包装">
    </el-table-column>
    <el-table-column
      prop="出货周期"
      align="center"
      label="出货周期">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.出货周期}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="警戒库存"
      align="center"
      label="警戒库存">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.警戒库存}}</span>
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
<el-dropdown trigger="click" placement="bottom"  @command="handleCommand">
  <span class="el-dropdown-link">
    <i class="el-icon-arrow-down el-icon--right" @click="setFormData(scope.row)"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item command="1">修改编辑</el-dropdown-item>
    <el-dropdown-item command="2">添加供应商</el-dropdown-item>
    <el-dropdown-item command="3">商品下架</el-dropdown-item>
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
      :total="goodsInfo.count">
    </el-pagination>
 <el-dialog title="商品编辑" :visible.sync="goodsFormVisible" center>
          <el-form :model="cardForm" class="form">
            <el-form-item label="商品名称" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.商品名称" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="商品条码" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.商品条码" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="规格型号" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.规格型号" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="商品品类" label-width="120px">
              <el-col :span="10">
              <el-select v-model="cardForm.商品品类" placeholder="">
                <el-option label="时令生鲜" value="时令生鲜"></el-option>
                <el-option label="汽车电子" value="汽车电子"></el-option>
                <el-option label="时尚3C" value="时尚3C"></el-option>
              </el-select>
              </el-col>
              <el-col :span="2">
                销售单位
              </el-col>
              <el-col :span="10">
              <el-select v-model="cardForm.销售单位" placeholder="">
                <el-option label="个" value="个"></el-option>
                <el-option label="套" value="套"></el-option>
                <el-option label="件" value="件"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="出厂包装" label-width="120px">
              <el-col :span="10">
              <el-select v-model="cardForm.出厂包装" placeholder="">
                <el-option label="塑料箱" value="塑料箱"></el-option>
                <el-option label="纸箱" value="纸箱"></el-option>
                <el-option label="中性纸盒" value="中性纸盒"></el-option>
                <el-option label="PP袋" value="PP袋"></el-option>>
              </el-select>
              </el-col>
              <el-col :span="2">
                商品属性
              </el-col>
              <el-col :span="10">
              <el-select v-model="cardForm.商品属性" placeholder="">
                <el-option label="赠品" value="赠品"></el-option>
                <el-option label="正价商品" value="正价商品"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="警戒库存" label-width="120px">
              <el-col :span="12">
              <el-input v-model="cardForm.警戒库存" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="供应商" label-width="120px">
              <el-col :span="24">
              <el-select v-model="cardForm.供应商" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
              <el-col :span="10">
                 <el-input v-model="cardForm.供货价" auto-complete="off" placeholder="供货价"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
                 <el-input v-model="cardForm.交货周期" auto-complete="off" placeholder="交货周期"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="成本控制" label-width="120px">
              <el-col :span="10">
              <el-input v-model="cardForm.运输费用" auto-complete="off" placeholder="运输费用"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
              <el-input v-model="cardForm.包装费用" auto-complete="off" placeholder="包装费用"></el-input>
              </el-col>
              <el-col :span="24" >
              产品成本价<span style="color:blue;margin-left:4px">9999</span>
              </el-col>
              <el-col :span="10">
              <el-input v-model="cardForm.零售价" auto-complete="off" placeholder="零售价"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
              <el-input v-model="cardForm.利润率" auto-complete="off" placeholder="利润率"></el-input>
              </el-col>
            </el-form-item>
          </el-form>
          <div slot="footer" class="dialog-footer">
            <el-button type="success"  @click="dialogFormVisible = false">保存</el-button>
          </div>
        </el-dialog>
        </div>
</template>

<script>
  export default {
    data() {
      return {
        goodsFormVisible:false,
      contextPath:"",
        cardForm:{},
        param:{
          pageIndex:1,
          pageSize:20,
          condition:{},
        },
        goodsInfo:{
          count:0,
          data:[],
        },
      }
    },
      created:function(){
          this.getGoodsInfo();
      },
      methods:{
      setFormData:function(row){
        var self=this;
        self.cardForm=row
      },
      getGoodsInfo:function(){
        var self=this;
        this.$axios.post(this.contextPath + "/api/commodity/query",JSON.stringify(self.param)).then(function(res){
          if(res.data.status==1){
            self.goodsInfo=res.data
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
        this.$axios.post(this.contextPath + "/api/commodity/update",JSON.stringify(self.cardForm)).then(function(res){
          if(res.data.status==1){
        self.$message({
                  showClose: true,
                  message: '操作成功',
                  type: 'success'
                });
            self.goodsFormVisible=false,
            self.getGoodsInfo()

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
          this.goodsFormVisible=true
        }
        if(command=='2'){
        self.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
        if(command=='3'){
        this.$axios.post(this.contextPath + "/api/commodity/delete",JSON.stringify(self.cardForm.发行编码)).then(function(res){
          if(res.data.status==1){
        self.$message({
                  showClose: true,
                  message: '操作成功',
                  type: 'success'
                });
            self.getGoodsInfo()
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
